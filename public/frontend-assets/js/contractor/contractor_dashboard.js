// public/frontend-assets/js/contractor/contractor_dashboard.js


$(document).ready(function () {
    $('.accordion-button').on('click', function () {
        $(this).parent().find('.accordion-collapse').toggleClass('show');
    });
});

$(document).ready(function() {
    $('.project-status-link').on("click", function(e) {
        sessionStorage.setItem("lastname", "smith");
    });
});

$(document).ready(function() {
    // Ensure that the `projects` variable is defined and accessible
    if (typeof projectData !== 'undefined' && Array.isArray(projectData)) {

        function debounce(func, wait) {
            let timeout;
            return function(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        function getMessageCount(userId, projectId, role) {
            // axios.post('/get-message-count', {
            //     userId: userId,
            //     projectId: projectId,
            //     role: role
            // }).then(response => {
            //     let messageCount = response.data.messageCount;
            //     updateMessageCount(messageCount, projectId);
            // }).catch(error => {
            //     console.error('Error fetching message count:', error.response ? error.response.data : error);
            // });
        }

        function updateMessageCount(count, projectId) {
            let messageCountElement = $('#chat-notification-contractorside-' + projectId);
            let messageCountgrid = $('#chat-notification-contractorsidegrid-' + projectId);
            messageCountElement.text(count);
            messageCountgrid.text(count);

            if (count === 1) {
                $('#chatnow-' + projectId).load(location.href + ' #chatnow-' + projectId);
                $('#chatnowgrid-' + projectId).load(location.href + ' #chatnowgrid-' + projectId);
            }

            if(count === 0){
                $('#chatnow-' + projectId).load(location.href + ' #chatnow-' + projectId);
                $('#chatnowgrid-' + projectId).load(location.href + ' #chatnowgrid-' + projectId);
            }    
        }

        projectData.forEach(project => {
            let projectId = project.id;
            let userId = project.user_id;
            let role = 'customer';

            const debouncedGetMessageCount = debounce(() => {
                getMessageCount(userId, projectId, role);
            }, 1000);

            getMessageCount(userId, projectId, role);

            window.Echo.channel(`update-real-time-count-contractor-side.${projectId}`)
                .listen('UnreadMessageCountUpdated', (e) => {
                    console.log('UnreadMessageCountUpdated event received:', e);
                    updateMessageCount(e.messageCount, projectId);
                });

            setInterval(() => {
                debouncedGetMessageCount();
            }, 5000);
        });
    } else {
        console.error('Projects data is not available');
    }
});

$(document).ready(function() {

    // $('.btn-gallery-filter-dash').click(function(e) {
        // e.preventDefault();

        // var category = $(this).attr('data-category_status');
        // $('.btn-gallery-filter-dash').removeClass('active');
        // $(this).addClass('active');

        // if (category == 'all') {
        //     $('.item').removeClass('hide');
        // } else {
        //     $('.item').each(function() {
        //         var itemCategory = $(this).attr('data-cate');
        //         if (itemCategory && itemCategory.includes(category)) {
        //             $(this).removeClass("hide");
        //         } else {
        //             $(this).addClass('hide');
        //         }
        //     });
        // }
    // });

    // import route from 'ziggy';
    // import { Ziggy } from './ziggy';

    // // filter 
    // $(document).ready(function() {

      

    //     $('#filterButton').on('click', function () {
    //         var categoryName = $('#ajax_filter_dash').find('.btn-gallery-filter-dash.active').data('cate');
    //         var fromDate = $('#from_date').val();
    //         var toDate = $('#to_date').val();
    //         var title = $('#title').val();
    
    //         $.ajax({
    //             url: route('contractor.dashboard', [], false, Ziggy),
    //             type: 'GET',
    //             data: { 
    //                 from_date: fromDate,
    //                 to_date: toDate,
    //                 title: title,
    //                 project_status: categoryName,
    //             },
    //             success: function (data) {
    //                 $('#test').html(data.html);
    //             },
    //             error: function (xhr, status, error) {
    //                 console.error(error);
    //             }
    //         });
    
    //         $(document).on('click', '.pagination a', function (event) {
    //             event.preventDefault();
    //             var url = $(this).attr('href');
    //             $.get(url, function (data) {
    //                 $('#test').html(data.html);
    //                 $('html, body').animate({ scrollTop: $('#test').offset().top }, 'slow');
    //             });
    //         });
    //     });
    // });
    
// // Import necessary modules
// const route = require('ziggy').default;
// const { Ziggy } = require('ziggy');

// $(document).ready(function() {
//     $('#filterButton').on('click', function () {
//         var categoryName = $('#ajax_filter_dash').find('.btn-gallery-filter-dash.active').data('cate');
//         var fromDate = $('#from_date').val();
//         var toDate = $('#to_date').val();
//         var title = $('#title').val();

//         $.ajax({
//             url: route('contractor.dashboard', [], false, Ziggy),
//             type: 'GET',
//             data: { 
//                 from_date: fromDate,
//                 to_date: toDate,
//                 title: title,
//                 project_status: categoryName,
//             },
//             success: function (data) {
//                 $('#test').html(data.html);
//             },
//             error: function (xhr, status, error) {
//                 console.error(error);
//             }
//         });

//         $(document).on('click', '.pagination a', function (event) {
//             event.preventDefault();
//             var url = $(this).attr('href');
//             $.get(url, function (data) {
//                 $('#test').html(data.html);
//                 $('html, body').animate({ scrollTop: $('#test').offset().top }, 'slow');
//             });
//         });
//     });
// });

    // Import Ziggy routes and utilities

// const route = require('ziggy').default;
// const { Ziggy } = require('ziggy');




});
