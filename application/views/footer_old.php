
<?php
$get_setting=$this->Crud_model->get_single('setting');
?>
<footer>
                <div class="blocknwe">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-3 column">
                                <div class="widget">
                                    <div class="about_widget">
                                        <div class="logo">
                                            <a href="##" title=""><img src="<?=base_url(); ?>assets/images/gig-work01-w.png" alt="" /></a>
                                        </div>
                                        <span>
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                                        </span>
                                    </div>
                                    <!-- About Widget -->
                                </div>
                            </div>
                            <div class="col-lg-3 column">
                                <div class="widget">
                                    <h3 class="footer-title">Quick Links</h3>
                                    <div class="link_widgets">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <a href="#" title="">Our Services</a>
                                                <a href="<?= base_url('employer_list')?>" title="Employer">Vendors</a>
                                                <a href="<?= base_url('employees_list')?>" title="Employees">Employees</a>
                                                <a href="<?= base_url('workers_list')?>" title="workers">Freelancer</a>
                                                <a href="<?= base_url('pricing')?>" title="">Pricing</a>
                                            </div>
                                            <!-- <div class="col-lg-6">
                                                <a href="#" title="">Residential</a>
                                                <a href="#" title="">Commercial</a>
                                                <a href="#" title="">Virtual</a>
                                                <a href="#" title="">Services</a>
                                                <a href="<?= base_url('pricing')?>" title="">Pricing</a>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 column">
                                <div class="widget">
                                    <h3 class="footer-title">Support Link</h3>
                                    <div class="link_widgets">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <a href="<?= base_url('about-us')?>" title="About us">About Us</a>
                                                <a href="<?= base_url('contact-us')?>" title="Contact us">Contact Us</a>
                                                <a href="<?= base_url('privacy-policy')?>" title="privacy policy">Privacy Policy</a>
                                                <a href="<?= base_url('term-and-conditions')?>" title="Term & condition">Terms & Conditions </a>
                                                <a href="#" title="">Our Safty</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 column">
                                <div class="about_widget">
                                    <h3 class="footer-title">Contact Us</h3>
                                    <span><?= $get_setting->address?></span>
                                    <span><?= $get_setting->phone ?></span>
                                    <span><?= $get_setting->email ?></span>
                                    <div class="social">
                                        <a href="#" title=""><i class="fa fa-facebook"></i></a>
                                        <a href="#" title=""><i class="fa fa-twitter"></i></a>
                                        <a href="#" title=""><i class="fa fa-linkedin"></i></a>
                                        <a href="#" title=""><i class="fa fa-pinterest"></i></a>
                                        <a href="#" title=""><i class="fa fa-behance"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bottom-line">
                    <span>Copyright © 2021 GIGWORK.PRO. All rights reserved.</span>
                    <a href="#scrollup" class="scrollup" title=""><i class="la la-arrow-up"></i></a>
                </div>
            </footer>
        </div>

        <div class="account-popup-area signin-popup-box">
            <div class="account-popup">
                <span class="close-popup"><i class="la la-close"></i></span>
                <h3>User Login</h3>
                <span>Click To Login With Demo User</span>
                <div class="select-user">
                    <span>Candidate</span>
                    <span>Employer</span>
                </div>
                <form>
                    <div class="cfield">
                        <input type="text" placeholder="Username" />
                        <i class="la la-user"></i>
                    </div>
                    <div class="cfield">
                        <input type="password" placeholder="********" />
                        <i class="la la-key"></i>
                    </div>
                    <p class="remember-label"><input type="checkbox" name="cb" id="cb1" /><label for="cb1">Remember me</label></p>
                    <a href="#" title="">Forgot Password?</a>
                    <button type="submit">Login</button>
                </form>
                <div class="extra-login">
                    <span>Or</span>
                    <div class="login-social">
                        <a class="fb-login" href="#" title=""><i class="fa fa-facebook"></i></a>
                        <a class="tw-login" href="#" title=""><i class="fa fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- LOGIN POPUP -->

        <div class="account-popup-area signup-popup-box">
            <div class="account-popup">
                <span class="close-popup"><i class="la la-close"></i></span>
                <h3>Sign Up</h3>
                <div class="select-user">
                    <span class="candidate-tab">Candidate</span>
                    <span class="employer-tab">Employer</span>
                </div>
                <form>
                    <div class="cfield">
                        <input type="text" placeholder="Username" name="username" />
                        <i class="la la-user"></i>
                    </div>
                    <div class="cfield">
                        <input type="password" placeholder="********" name="password" />
                        <i class="la la-key"></i>
                    </div>
                    <div class="cfield">
                        <input type="text" placeholder="Email" name="email" />
                        <i class="la la-envelope-o"></i>
                    </div>
                    <div class="dropdown-field">
                        <select data-placeholder="Please Select Specialism" name="service" class="chosen">
                            <option>Web Development</option>
                            <option>Web Designing</option>
                            <option>Art & Culture</option>
                            <option>Reading & Writing</option>
                        </select>
                    </div>
                    <div class="cfield">
                        <input type="text" placeholder="Phone Number" name="mobile" />
                        <i class="la la-phone"></i>
                    </div>
                    <input type="hidden" name="user_type" class="user_type">
                    <button type="submit">Signup</button>
                </form>
                <div class="extra-login">
                    <span>Or</span>
                    <div class="login-social">
                        <a class="fb-login" href="#" title=""><i class="fa fa-facebook"></i></a>
                        <a class="tw-login" href="#" title=""><i class="fa fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- SIGNUP POPUP -->

        <input type="hidden" name="base_url" id="base_url" value="<?= base_url()?>">
         <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>

        <script src="<?=base_url(); ?>assets/js/modernizr.js" type="text/javascript"></script>
        <script src="<?=base_url(); ?>assets/js/script.js" type="text/javascript"></script>
        <script src="<?=base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?=base_url(); ?>assets/js/wow.min.js" type="text/javascript"></script>
        <script src="<?=base_url(); ?>assets/js/slick.min.js" type="text/javascript"></script>
        <script src="<?=base_url(); ?>assets/js/parallax.js" type="text/javascript"></script>
        <script src="<?=base_url(); ?>assets/js/select-chosen.js" type="text/javascript"></script>
        <script src="<?=base_url(); ?>assets/js/custom.js" type="text/javascript"></script>
         <script src="<?= base_url('assets/js/jquery.scrollbar.min.js')?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/js/maps2.js')?>" type="text/javascript"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/datepicker.js" type="text/javascript"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/i18n/datepicker.en.js" type="text/javascript"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtg6oeRPEkRL9_CE-us3QdvXjupbgG14A&libraries=places&callback=initMap"
async defer></script>

<script type="text/javascript" src="<?= base_url('assets/custom_js/validation.js')?>"></script>

<script src="<?= base_url();?>dist/assets/notify/notify.min.js"></script>
<script type="text/javascript">

        $(document).ready(function(){
      var sessionMessage = '<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>';
      if(sessionMessage==null || sessionMessage=="" ){ return false;}
      $.notify(sessionMessage,{ position:"top right",className: 'success' });//session msg
        });

    </script>

     <script>
            $(document).ready(function(){
               $('[data-toggle="offcanvas"]').click(function(){
                   $("#navigation").toggleClass("hidden-xs");
               });
            });
        </script>
        <script type="text/javascript">
         $(document).ready(function(){
 $('.datetimepicker').datepicker({
     timepicker: true,
     language: 'en',
     range: true,
     multipleDates: true,
         multipleDatesSeparator: " - "
   });
 $("#add-event").submit(function(){
     alert("Submitted");
     var values = {};
     $.each($('#add-event').serializeArray(), function(i, field) {
         values[field.name] = field.value;
     });
     console.log(
       values
     );
 });
});

(function () {
   'use strict';
   // ------------------------------------------------------- //
   // Calendar
   // ------------------------------------------------------ //
   $(document).ready(function() {
       // page is ready
       $('#calendar').fullCalendar({
           themeSystem: 'bootstrap4',
           // emphasizes business hours
           businessHours: false,
           defaultView: 'month',
           // event dragging & resizing
           editable: true,
           // header
           header: {
               left: 'title',
               center: 'month,agendaWeek,agendaDay',
               right: 'today prev,next'
           },
           events: [
               {
                   title: 'Barber',
                   description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
                   start: '2020-05-05',
                   end: '2020-05-05',
                   className: 'fc-bg-default',
                   icon : "circle"
               },
               {
                   title: 'Flight Paris',
                   description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
                   start: '2020-08-08T14:00:00',
                   end: '2020-08-08T20:00:00',
                   className: 'fc-bg-deepskyblue',
                   icon : "cog",
                   allDay: false
               },
               {
                   title: 'Team Meeting',
                   description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
                   start: '2020-07-10T13:00:00',
                   end: '2020-07-10T16:00:00',
                   className: 'fc-bg-pinkred',
                   icon : "group",
                   allDay: false
               },
               {
                   title: 'Meeting',
                   description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
                   start: '2020-08-12',
                   className: 'fc-bg-lightgreen',
                   icon : "suitcase"
               },
               {
                   title: 'Conference',
                   description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
                   start: '2020-08-13',
                   end: '2020-08-15',
                   className: 'fc-bg-blue',
                   icon : "calendar"
               },
               {
                   title: 'Baby Shower',
                   description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
                   start: '2020-08-13',
                   end: '2020-08-14',
                   className: 'fc-bg-default',
                   icon : "child"
               },
               {
                   title: 'Birthday',
                   description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
                   start: '2020-09-13',
                   end: '2020-09-14',
                   className: 'fc-bg-default',
                   icon : "birthday-cake"
               },
               {
                   title: 'Restaurant',
                   description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
                   start: '2020-10-15T09:30:00',
                   end: '2020-10-15T11:45:00',
                   className: 'fc-bg-default',
                   icon : "glass",
                   allDay: false
               },
               {
                   title: 'Dinner',
                   description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
                   start: '2020-11-15T20:00:00',
                   end: '2020-11-15T22:30:00',
                   className: 'fc-bg-default',
                   icon : "cutlery",
                   allDay: false
               },
               {
                   title: 'Shooting',
                   description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
                   start: '2020-08-25',
                   end: '2020-08-25',
                   className: 'fc-bg-blue',
                   icon : "camera"
               },
               {
                   title: 'Go Space :)',
                   description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
                   start: '2020-12-27',
                   end: '2020-12-27',
                   className: 'fc-bg-default',
                   icon : "rocket"
               },
               {
                   title: 'Dentist',
                   description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
                   start: '2020-12-29T11:30:00',
                   end: '2020-12-29T012:30:00',
                   className: 'fc-bg-blue',
                   icon : "medkit",
                   allDay: false
               }
           ],
           eventRender: function(event, element) {
               if(event.icon){
                   element.find(".fc-title").prepend("<i class='fa fa-"+event.icon+"'></i>");
               }
             },
           dayClick: function() {
               $('#modal-view-event-add').modal();
           },
           eventClick: function(event, jsEvent, view) {
                   $('.event-icon').html("<i class='fa fa-"+event.icon+"'></i>");
                   $('.event-title').html(event.title);
                   $('.event-body').html(event.description);
                   $('.eventUrl').attr('href',event.url);
                   $('#modal-view-event').modal();
           },
       })
   });

})(jQuery);
     </script>


    </body>
</html>
