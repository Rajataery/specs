@extends('layouts.frontend')
@section('content')

<div class="section about-us-page">
        <div class="container ">
            <div class="full-section">
                <div class="hero-left about-us-content">
                    <h2>About <span>Us</span></h2>
                    <p>At First Aid Guru we understand the true importance of first aid training. Not just for businesses to
                        comply with health and safety
                        regulations and for individuals to improve their life skills. We believe that the more people are
                        trained in first aid techniques,
                        the safer the world will be for everyone. </p>
                    <p>We’re passionate about teaching first aid and want to empower people and organisations to make a
                        difference. First aid is a simple
                        skill that could mean the difference between life and death in an emergency situation and our
                        courses provide all the information
                        you need to become a fully qualified first aider.</p>
                    <p>Finding the right course for you is made easy with First Aid Guru. We simplify the process so you can
                        quickly identify the course
                        that suits your needs. From searching and booking, to course attendance and receiving your
                        certificate, we remove the hassle and
                        guide you every step of the way. </p>
                </div>
                <div class="image-right-sectin">
                    <img src="{{ url('frontend/images/Mobile---BG-p-1600.jpeg')}}" loading="lazy" alt="">
                </div>
            </div>
    
        </div>
      <div class=" choose-us-section">
        <div class="container overlap-container">
            <h2>Why choose us</h2>
            <div class="benefits-holder homepage">
                <div class="benefit"><img src="{{ url('frontend/images/pound-icon.png')}}" loading="lazy" height="60"
                        width="90" alt="" class="top-icons">
                    <div class="h3">Never beaten on Price</div>
                    <div class="body-text top-benefit">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean
                        dictum augue id feugiat auctor. Quisque vulputate dui vel mi mattis egestas. </div>
                </div>
                <div class="benefit"><img src="{{ url('frontend/images/check-icon.png')}}" loading="lazy" height="60"
                        width="71" alt="" class="top-icons">
                    <div class="h3">Verified Experience</div>
                    <div class="body-text top-benefit">Organisations can meet compliance requirements that are essential for
                        their business</div>
                </div>
                <div class="benefit"><img src="{{ url('frontend/images/pin-icon.png')}}" loading="lazy" width="71"
                        height="60" alt="" class="top-icons">
                    <div class="h3">Nationwide Locations</div>
                    <div class="body-text top-benefit">Find a local first aid training provider close to your home or work
                        at a time that suits you</div>
                </div>
            </div>
        </div>
	  </div>

	  
  <section class="section contact" >
    <div  class="container contact">
      <div id="contact" class="contact-form-holder">
        <div class="h2 contact-form">Talk to us</div>
        <div class="form-block-2 w-form">
          <form id="email-form" action="{{ route('contact')}}" method="post" name="email-form" data-name="Email Form" class="form-2">
            @csrf
            <input type="text" class="name-box w-input" maxlength="256" name="name" data-name="Your name" placeholder="Your name" id="Your-name" required="">
            <input type="email" class="email-box w-input" maxlength="256" name="email" data-name="Your email" placeholder="Your email address" id="Your-email" required="">
            <textarea placeholder="Your message..." maxlength="5000" id="Your-message-2" name="message" data-name="Your Message 2" class="text-area message-box w-input" required=""></textarea>            
            <label class="contactTC">I agree to all the <a href="#">terms and conditions</a>
                <input type="checkbox">
                <span class="checkmark"></span>
              </label>
            <input type="submit" value="Send" data-wait="Please wait..." class="find-course-submit w-button">
            <span class="contactUs-number">Contact us at
             <a  id="inhouse_call_us" class="text-center" href="tel:0203 886 0025"> 0203 886 0025</a></span>
          </form>
        </div>
      </div>
    </div>
  </section>
    </div>

@endsection