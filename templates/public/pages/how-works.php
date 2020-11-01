<html lang="en">
<?= $loadTemplate("public/components/head_data.php", ["title" => "BeFinanced - Despre platforma"]); ?>

<body data-mobile-nav-trigger-alignment="right" data-mobile-nav-align="center" data-mobile-nav-style="minimal"
      data-mobile-nav-scheme="gray" data-mobile-header-scheme="gray" data-mobile-nav-breakpoint="1199">

<div id="wrap">

    <?= $loadTemplate("public/components/header.php") ?>

    <main id="content" class="content">
        <section class="vc_row py-5 d-flex flex-wrap align-items-center bg-cover bg-center"
                 style="background-image: url(<?= $getFileSrc("landing-page/img/background-loan.jpg") ?>); height: 35em">
            <div class="container">
                <div class="row">

                    <div
                            class="lqd-column col-md-10 col-md-offset-1 text-center"
                            data-custom-animations="true"
                            data-ca-options='{ "triggerHandler":"inview", "animationTarget":"all-childs", "duration":"1200", "delay":"150", "easing":"easeOutQuint", "direction":"forward", "initValues":{"translateY":60, "translateZ":-160, "rotateX":-84, "opacity":0}, "animations":{"translateY":0, "translateZ":0, "rotateX":0, "opacity":1} }'
                    >

                        <h2
                                class="text-white mt-0 mb-30"
                                data-split-text="true"
                                data-split-options='{"type":"lines"}'
                                data-fittext="true"
                                data-fittext-options='{"compressor": 0.75, "maxFontSize": 60}'>
                            Afla care este misiunea beFinanced
                        </h2>
                    </div>
                </div>
            </div>
        </section>

        <section id="features" class="vc_row pt-180 pb-70">

            <div class="container">
                <div class="row d-flex flex-wrap align-items-center">

                    <div class="lqd-column col-md-6">

                        <div class="liquid-img-group-container mb-md-0">
                            <div class="liquid-img-group-inner">
                                <div class="liquid-img-group-single" data-shadow-style="4" data-roundness="4"
                                     data-inview="true" data-animate-shadow="true">
                                    <div class="liquid-img-group-img-container">
                                        <div class="liquid-img-group-content content-floated-mid">
                                            <a href="https://youtu.be/She-eJkPPl0"
                                               class="btn btn-naked fresco btn-icon-block btn-icon-top btn-icon-xxlg btn-icon-circle btn-icon-solid btn-icon-ripple">
													<span>
														<span class="btn-icon font-size-18 bg-white text-dark">
															<i class="fa fa-play"></i>
														</span>
													</span>
                                            </a>
                                        </div><!-- /.liquid-img-group-content -->
                                        <div class="liquid-img-container-inner">
                                            <figure>
                                                <img src="<?= $getFileSrc("landing-page/img/sales.jpg") ?>"
                                                     alt="Setup Ave"/>
                                            </figure>
                                        </div><!-- /.liquid-img-container-inner -->
                                    </div><!-- /.liquid-img-group-img-container -->
                                </div><!-- /.liquid-img-group-single -->
                            </div><!-- /.liquid-img-group-inner -->
                        </div><!-- /.liquid-img-group-container -->

                    </div><!-- /.col-md-6 -->

                    <div class="lqd-column col-md-6 pl-md-6 pr-md-7">

                        <header class="fancy-title mb-35">
                            <h2 class="mt-0 mb-4 pr-md-5">Obtine o finantare rapid si online</h2>
                            <p>Cu ajutorul platformei beFinanced, poti aplica pentru o finantare la un numar mare de
                                institutii financiare, cu o singura aplicatie completata. De asemenea, ai acces rapid la
                                numeroase oferte.</p>
                        </header>

                        <a href="#" target="_blank"
                           class="btn btn-solid btn-sm semi-round btn-bordered border-thin fresco px-2 font-size-15">
								<span>
									<span class="btn-txt">Aplica chiar acum pentru un credit</span>
								</span>
                        </a>

                    </div><!-- /.col-md-6 -->

                </div><!-- /.row -->
            </div><!-- /.container -->

        </section>


        <section class="vc_row pt-70 pb-90">
            <div class="container">
                <div class="row">
                    <header class="fancy-title mb-35">
                        <h2 class="mt-0 mb-4 pr-md-5">Cum este arhitecturat proiectul beFinanced?</h2>
                        <p>BeFinanced este dezvoltat in limbajul de programare PHP 7.4, folosind majoritatea
                            facilitatilor disponibile in aceasta versiune. Proiectul dispune de o baza de date
                            relationala, MySQL 5.7, iar web server-ul instalat este Apache.</p>
                        <p>Proiectul beFinanced are o arhitectura monolit. Toate cele trei layere de baza ale unei
                            aplicatii web (presentation, domain, data source) sunt realizate sub acelasi proiect. Fiind
                            vorba despre un MVP, putem aborda aceasta arhitectura pentru a avea un produs minim gata de
                            testare. Pe viitor, daca acest proiect va urma sa fie dezvoltat mai mult decat un "stadiu de
                            idee", atunci se va aborda o arhitectura moderna, bazata pe microservicii.</p>
                        <p>Aplicatia are la baza o colectie de module dezvoltate "in-house", un sistem simplu de
                            routing, aplicand design pattern-ul MVC (Model-View-Controller) pentru logica
                            programului. Aplicatia foloseste composer, pentru autowiring, cat si pentru instalarea unor
                            module externe, pe viitor (momentan, este instalat PHPUnit, pentru crearea unor teste
                            unitare in cursul dezvoltarii programului). Logica de business va fi tinuta in diverse
                            servicii, legatura intre Request - View va fi intermediata de catre Controller, iar
                            tabelele din db vor fi mapate in entitati, pentru o mai buna organizare si dezvoltare. In
                            cadrul acestui proiect, o sa fie dezvoltat un "mini-ORM", pentru a abstractiza operatiile
                            facute in baza de date.</p>
                        <p>Rutele (paginile) sunt definite in config/routes.php, fiecare ruta fiind reprezentata de un
                            array asociativ. (posibil, in cursul dezvoltarii, sa fie implementate intr-o maniera OOP).
                            Fiecare ruta are asociata o functie intr-un controller, pentru a putea intermedia request-ul
                            ce este trimis si raspunsul pe care il trimitem.</p>
                        <p>View-urile sunt tinute in fisiere, denumite "templates", pentru o mai buna organizare a
                            partii vizuale
                            si pentru a putea refolosi componentele intr-un mod mult mai facil.</p>
                    </header>

                    <a target="_blank" href="<?= $getFileSrc("img/eer_diagram.svg") ?>">
                        <img src="<?= $getFileSrc("img/eer_diagram.svg") ?>" alt="Click pentru full-screen"/>
                    </a>

                    <p>Mai sus este reprezentata diagrama bazei de date. Dupa cum se poate observa, structura este
                        realizata pentru a realiza un "marketplace" de credite, cu interactiune online. In cadrul
                        platformei, pot exista 2 tipuri de utilizatori interactivi: client sau operator al unei
                        institutii financiare (Banca, IFN, etc).</p>
                    <p>Un client poate depune o aplicatie online catre un
                        anumit tip de credit (va fi incarcat, ulterior, un nomenclator cu cele mai solicitate credite
                        pentru pers fizice si juridice), in care va selecta catre ce institutii va trimite aplicatia (o
                        aplicatie poate sa fie catre multiple institutii, fiecare trimitand un anumit raspuns). Pentru a
                        putea face asta, avem o relatie ManyToMany intre tabela de credit_application si
                        financial_institution. Dupa ce fiecare institutie financiara a primit aplicatia, aceasta poate
                        sa ofere un raspuns (stocat in credit_answer), cu un anumit status de raspuns (refuzat,
                        acceptat, este nevoie de date suplimentare, etc). Ulterior, se pot solicita anumite documente
                        (va fi un status de raspuns pentru asta), utilizatorii putand sa le incarce intr-un formular de
                        upload (va fi stocata o referinta a documentelor incarcate in tabela credit_documents).</p>
                    <p>Pentru urmatorul nivel (nivelul 2), vor fi realizate entitatile (maparea tabelelor ca si clase
                        in PHP), pentru a facilita realizarea operatiilor tip CRUD pe tabelele respective. De asemenea,
                        in realizarea ORM-ului, vor fi luate in considerare posibilele vulnerabilitati de securitate ce
                        pot aparea in contactul cu baza de date (SQL injection).</p>

                </div><!-- /.row -->
            </div><!-- /.container -->
        </section>

    </main><!-- /#content.content -->

    <?= $loadTemplate("public/components/footer.php") ?>

</div><!-- /#wrap -->


<?= $loadTemplate('public/components/scripts.php') ?>

</body>
</html>