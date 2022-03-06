<?php include(INCS . 'header.php'); ?>

<div class="container">
    <!-- contact1 -->
    <div class=" section-gap"></div>
    <div class="wrapper">
        <h3 class="global-title text-center">Contactez nous</h3>
        <div class="d-grid contact-view">
            <div class="cont-details">


                <div class="cont-top">

                    <div class="cont-left text-center">
                        <span class="fa fa-phone"></span>
                    </div>

                    <div class="cont-right">
                        <h6>Telephone</h6>
                        <p><a href="#">+123 45 67 89</a></p>
                    </div>

                </div>


                <div class="cont-top margin-up">

                    <div class="cont-left text-center">
                        <span class="fa fa-envelope-o"></span>
                    </div>
                    <div class="cont-right">
                        <h6>Email</h6>
                        <p><a href="mailto:example@mail.com" class="mail">example@mail.com</a></p>
                    </div>

                </div>


                <div class="cont-top margin-up">
                    <div class="cont-left text-center">
                        <span class="fa fa-map-marker"></span>
                    </div>
                    <div class="cont-right">
                        <h6>Adresse</h6>
                        <p>Address here, Lorem, ipsum dolor.</p>
                    </div>
                </div>
            </div>



            <div class="map-content mb-4">
                <?php
                if (isset($_COOKIE['errors'])) {
                    echo "<div class='alert alert-danger'>" . $_COOKIE['errors'] . "</div>";
                }
                if (isset($_COOKIE['msgNotSent'])) {
                    echo "<div class='alert alert-danger'>" . $_COOKIE['msgNotSent'] . "</div>";
                }
                if (isset($_COOKIE['msgSent'])) {
                    echo "<div class='alert alert-success'>" . $_COOKIE['msgSent'] . "</div>";
                }
                ?>
                <form action="<?php url('contact/send') ?>" method="post">
                    <div class="twice-two">
                        <input type="text" class="form-control" name="name" id="w3lName" placeholder="Name" required="">
                        <input type="email" class="form-control" name="email" id="w3lSender" placeholder="Email" required="">
                    </div>

                    <div class="twice">
                        <select name="city" id="" class="form-control">
                            <option hidden>-- Votre Ville --</option>
                        <?php foreach(getCities() as $city): ?>
                            <option value="<?= $city['id'] ?>"><?= $city['ville'] ?></option>
                        <?php endforeach ?>
                        </select>
                    </div>

                    <div class="twice">
                        <input type="text" class="form-control" name="phone" id="w3lSubject" placeholder="Phone" required="">
                    </div>

                    <div class="twice">
                        <input type="text" class="form-control" name="subject" id="w3lSubject" placeholder="Subject" required="">
                    </div>

                    <textarea name="message" class="form-control" id="message" placeholder="Message" required=""></textarea>
                    <button type="submit" name="send" class="btn btn-contact">Envoyer</button>
                </form>
            </div>



        </div>
    </div>

    <!-- /contact1 -->
</div>

<?php include(INCS . 'footer.php'); ?>