import './bootstrap';
window.Echo.private('App.Models.User.'+id)
.notification((event)=>{
    $('#push-notification').prepend(`<div class="dropdown-item d-flex justify-content-between align-items-center">
                                         <span> Post Comment :
                                             ${event.post_title.substring(0,9)}...</span>
                                         <a href="${event.link}?notify=${event.id}">
                                             <i class="fa fa-eye"></i></a>
                                     </div> `);
   count =Number( $('#count-notification').text());
   count++;
   $('#count-notification').text(count);
});
