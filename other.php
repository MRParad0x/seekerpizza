<div class="footer-container">

<div class="footer-inline-box-one">
<h3>Seekers Pizza</h3>
    <img src="img/logosquare.png" alt="">
    <h3>Follow us on social</h3>
    <div class="icons">
        <a href="facebook.com" class="fa-brands fa-facebook-f"></a>
        <a href="instagram.com" class="fa-brands fa-instagram"></a>
        <a href="twitter.com" class="fa-brands fa-twitter"></a>
        <a href="youtube.com" class="fa-brands fa-youtube"></a>
        <a href="tiktok.com" class="fa-brands fa-tiktok"></a>
    </div>
</div>

<div class="footer-inline-box-two">
<h3>About Us</h3>
<p>The Seekers Pizza is all about fun and good times with people you care about, sharing original Italian pizza, hand-made in the traditional Italian way: thin & crispy, and deliciously baked in the only original wood-fired oven in Sri Lanka, along with a tasty range of authentic Italian food with carefully-sourced fresh ingredients sourced and imported from Italy, is ought to have your tastebuds craving for more, after one bite.</p>
</div>

<div class="footer-inline-box-three">
    <h3>Contact Us</h3>
    <h4>Address</h4>
    <p>10C, Pitipana Road, Kaduwela</p>
    <h4>Hotline</h4>
    <p>+94 112768453</p>
    <h4>Email</h4>
    <p>support@seekerspizza.com</p>
    <h3>Opening Hours</h3>
    <p>Monday -  Sunday</p>
    <p>11:00 AM -  11:00 PM</p>
</div>

<!-- <div class="footer-inline-box-four">
<h3>Customer Service</h3>
<a href="#login">Sign in</a>
<a href="#register">Register</a>
<a href="#TOS">Term of Use</a>
<a href="#PP">Privacy Policy</a>
</div> -->

</div>


.footer .flex .navbar a{
    display: inline-flex;
    text-align: center;
    align-items: center;
    justify-content:center;
    font-size: 2em;
    color:#ffffff;
    text-decoration: none;;
}

.footer .flex .footer-container{
    display: flex;
    position: relative;
    align-items: center;
    justify-content: space-between;
}

.footer .flex .footer-container .footer-inline-box-one,
.footer .flex .footer-container .footer-inline-box-two,
.footer .flex .footer-container .footer-inline-box-three,
.footer .flex .footer-container .footer-inline-box-four{
    display:block;
    width: 350px;
    height: auto;
    color: #ffffff;
    font-family: var(--header-menu-font-style);
    text-align: center;
}

.footer .flex .footer-container .footer-inline-box-one h3{
    border: solid #b8b8b852 2px;
    border-radius: 50px;
}

.footer .flex .footer-container .footer-inline-box-two h3{
    border: solid #b8b8b852 2px;
    border-radius: 50px;
}

.footer .flex .footer-container .footer-inline-box-three h3{
    border: solid #b8b8b852 2px;
    border-radius: 50px;
}

.footer .flex .footer-container .footer-inline-box-one img{
    width: 70%;
}

.footer .flex .footer-container .footer-inline-box-one .icons a{
    display: inline-flex;
    align-items: center;
    justify-content:center;
    width: 20px;
    height: 20px;
    padding: 5px;
    margin: 0 1px 0 1px;
    border-radius: 50px;
    background-color:#ffffff;
    text-decoration: none;
    color: #111;
}

.footer .flex .footer-container .footer-inline-box-one .icons a:hover{
    background-color: #FF4069;;
    color:#ffffff;
}

.footer .flex .footer-container .footer-inline-box-two p{
    text-align: justify;
    justify-content: center;
}

.footer .flex .footer-container .footer-inline-box-three p{
    line-height: 0.5em;
}

.footer .flex .footer-container .footer-inline-box-three h4{
    line-height: 1em;
}
