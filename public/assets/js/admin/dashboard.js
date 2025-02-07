const coursesPerTeacherCtx = document.getElementById('coursesPerTeacherCtx').getContext('2d');
const topCoursesByEnrollments = document.getElementById('topCoursesByEnrollments').getContext('2d');


fetch("/admin/getCoursesPerTeacher")
    .then(response => response.json())
    .then(data => {
        const lables = data.map(item => item.teacher_name);
        const values = data.map(item => item.TOTAL);
        new Chart(coursesPerTeacherCtx, {
            type: 'pie',
            data: {
                labels: lables,
                datasets: [{
                    label: 'Courses per Teacher',
                    data: values,
                    backgroundColor: [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0',
                        '#9966FF'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + '%';
                            }
                        }
                    }
                }
            }
        });
    });


fetch('/admin/getTopCoursesByEnrollments')
.then(response => response.json())
.then(data => {
    const labels = data.map(item => item.title);
    const enrollmentsData = data.map(item => item.TOTAL);

    new Chart(topCoursesByEnrollments, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                label: 'Enrollments',
                data: enrollmentsData,
                backgroundColor: [
                    '#FF6384',
                    '#36A2EB',
                    '#FFCE56',
                    '#4BC0C0',
                    '#9966FF'
                ],
                borderColor: [
                    '#FF6384',
                    '#36A2EB',
                    '#FFCE56',
                    '#4BC0C0',
                    '#9966FF'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw + ' enrollments';
                        }
                    }
                }
            }
        }
    });
})
