<img class="background-image" src="assets/images/abstract-2.jpeg" alt="picture of a blue orange">
<?php require __DIR__ . '/views/header.php'; ?>
<article>
    <?php if (isset($_SESSION['user'])) : ?>
        
        <div class="content-wrapper">
        <section class="content-feed">
            <p>
                <span>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Architecto laudantium delectus aliquam optio explicabo eius nostrum earum itaque illum adipisci eveniet temporibus similique voluptatem, tempore quas laborum, unde officiis dicta?</span>
                <span>Ipsa, eum. Neque alias esse error, odio illo itaque debitis molestias repellat, nisi ipsam porro ullam quidem corporis sint? Nihil possimus necessitatibus autem fugiat atque officiis praesentium quasi ad harum.</span>
                <span>Odio, similique quos ullam ipsa quia doloribus! Blanditiis doloribus, maxime vel nisi laborum quidem? Minima iste, cumque fuga, aut eveniet fugit hic sapiente voluptatum quasi velit nisi ex commodi rem!</span>
                <span>Labore, vero ab at, aliquam commodi praesentium, voluptas dolores eum rem ullam debitis nulla consequuntur provident minima exercitationem quam asperiores aliquid velit officia odio culpa architecto explicabo eos? Nemo, est!</span>
                <span>Vel rerum quos nulla eligendi cumque. Quos fuga adipisci officiis nemo, eos beatae error corrupti, maxime voluptatum doloribus vel dolor a. Accusantium ad aut ratione voluptatibus consectetur ipsum? Eveniet, a.</span>
            </p>
        </section>
        </div>

        <?php else : ?>
            <div class="start-info-container">
                <section class="start-info">
                    <h1>Welcome to Picture This!</h1>
                    <h5>This is just a simple btec version of Instagram made by Andreas Lindberg.</h5>
                    <h5>Don't have an account already? Click below to sign up and enjoy this crappy version of Instagram.</h5>
                    <button> <a class="sign-up-btn" href="signup.php">SIGN UP</a></button>
                </section>
            </div>

    <?php endif; ?>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>