<style>
    .footer {
        box-sizing: border-box;
        width: 100%;
        height: 15vh;
        margin: 0;
        padding: 5em;
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        align-items: center;
        background-color: #0175a7;
        position: relative;
    }

    .footer .social-media {
        box-sizing: border-box;
        width: 15%;
        height: auto;
        margin: 0;
        padding: 0.5em 0.75em;
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        align-items: center;
    }

    .footer .social-media i {
        font-size: 1.25em;
        color: white;
        transition: transform 1.25s;
    }

    .footer .social-media i:hover {
        color: #16A6F1;
        cursor: pointer;
    }

    .footer .copyright {
        font-size: 1.15em;
        color: white;
    }

    .footer .contact-info {
        box-sizing: border-box;
        width: 15%;
        height: auto;
        margin: 0;
        padding: 0.5em 0.75em;
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        align-items: center;
        font-size: 1.15em;
        color: white;
    }

    .footer .contact-info i {
        margin-right: 0.75em;
    }
</style>

<div class="footer">
    <!--social media-->
    <div class="social-media">
        <i class="fa-brands fa-facebook" title="Facebook"></i>
        <i class="fa-brands fa-instagram" title="Instagram"></i>
        <i class="fa-brands fa-tiktok" title="Tiktok"></i>
        <i class="fa-brands fa-twitter" title="Twitter"></i>
    </div>
    <!--copyright-->
    <div class="copyright">
        <p>All right reserved @ Fun Olympic Comittee &copy;</p>
    </div>
    <!--contact info-->
    <div class="contact-info">
        <i class="fa-solid fa-envelope"></i>
        <p>olympicComittee@gmail.com</p>
    </div>
</div>