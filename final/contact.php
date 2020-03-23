<?php include "includes/header.php"?>
    <div class="container">
      <form action="">
        <h1>Something Better</h1>
        <label for="fname">First Name</label>
        <input type="text" name="firstname" placeholder="First name" />
<br>
        <label for="lname"> Last  Name </label>
        <input type="text" name="lastname" placeholder="Last name" />
        <br>
        <label for="contact" class="contact">Phone Number</label>
        <input type="text" name="contact" placeholder="Contact Info" />

        <br>
        <label for="topic">What does this involve?</label>
        
        <select id="topic" name="topic">
          <option></option>
          <option>General Questions</option>
          <option>Catering</option>
          <option>Order Ahead</option>
        </select>
        <br>
        <label for="message">Message</label> <br>
    <textarea class="message" name="message" placeholder="How can we help?" cols="44" rows="4"></textarea>
    <br>
    <input type="submit" value="Submit">
      </form>
</div>
<div class="info">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d26448.19483447739!2d-118.26746303613248!3d34.04324636958084!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2c634253dfd01%3A0x26fe52df19a5a920!2sDowntown%20Los%20Angeles%2C%20Los%20Angeles%2C%20CA!5e0!3m2!1sen!2sus!4v1584549911692!5m2!1sen!2sus" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    <div class="address">
      <h3>776 E 2nd St, Los Angeles, California 90021</h3>
      <p>213.999.8888 <br>
      www.somethingbetter.com <br>
      Hours:<br>
    Monday - Thursday 10AM to 8pm <br> Friday - Sunday 10AM to 11PM</p>
</div>
    </div>
    <!-- Used jQuery to change label -->
    <script>
      $("document").ready(function(){
        let contactInfo = $('<label>');
        $(".contact").html("<label>Contact Info</label>");

        $("h1").css("color","white");
        $("h1").css("font-size","72px");
      });
    
    </script>
    <?php include "includes/footer.php"?>
