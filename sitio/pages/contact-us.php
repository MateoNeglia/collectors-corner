<?php
  
?>
<section class= "contact-form">
    <h2 class="mt-3 main-dark-color">Contact Us!</h2>
    <p class="mt-3 main-dark-color">Enter here your contact data and email content:</p>
    <form action="https://formspree.io/f/mzbokrqg" method="post" class="pb-3">
    <div class="form-group pb-3">
        <label class="pb-1" for="emailInput" >Email address</label>
        <input type="email" class="form-control" id="emailInput" name="visitor_email" placeholder="vtamertaichi@evjump.com" required>
    </div>
    <div class="row pb-3">
        <div class="col">
        <label class="pb-1" for="firstNameInput">First Name</label>
        <input type="text" class="form-control" id="firstNameInput" name="visitor_name" placeholder="Taichi">
        </div>
        <div class="col">
        <label class="pb-1" for="lastNameInput">Last Name</label>
            <input type="text" class="form-control" id="lastNameInput" name="visitor_last_name" placeholder="Yagami">
        </div>
    </div>
    <div class="form-group col pb-3">
        <label class="pb-1" for="inputState">Subject</label>
        <select id="inputState" class="form-control" name="email_subject">
            <option selected>Choose your mail subject</option>
            <option>Business</option>
            <option>Latest Promotions</option>
            <option>Purchase Issue</option>
            <option>Shipment Issue</option>
            <option>Other</option>
        </select>
        </div>
    <div class="form-group pb-3">
        <label class="pb-1" for="mailContentTextArea">Write here your email</label>
        <textarea class="form-control" id="mailContentTextArea" name="visitor_message" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-main text-light">Send Message!</button>
    </form>    
</section>
