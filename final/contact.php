<?php include "includes/header.php"?>
    <div class="container">
      <form action="">
        <label for="fname">First Name</label>
        <input type="text" name="firstname" placeholder="First name" />
<br>
        <label for="lname"> Last  Name </label>
        <input type="text" name="lastname" placeholder="Last name" />
        <br>
        <label for="topic">What does this involve?</label>
        
        <select id="topic" name="topic">
          <option></option>
          <option>General Questions</option>
          <option>Catering</option>
          <option>Order Ahead</option>
        </select>
        <br>
        <label for="message">Message</label>
    <textarea class="message" name="message" placeholder="How can we help?" cols="44" rows="4"></textarea>
    <br>
    <input type="submit" value="Submit">
      </form>
    </div>
    <?php include "includes/footer.php"?>
