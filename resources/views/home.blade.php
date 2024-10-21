<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Gate of Africa Conference</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>

        .stats-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .stat-item {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 10px;
            flex: 0 0 calc(33.333% - 20px);
            max-width: calc(33.333% - 20px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: transform 0.3s ease-in-out;
        }

        @media (min-width: 768px) {
            .stat-item {
                flex: 0 0 calc(16.666% - 20px);
                max-width: calc(16.666% - 20px);
            }
        }

        .stat-item:hover {
            transform: translateY(-5px);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 10px;
            opacity: 0;
            animation: fadeInUp 1s ease-out forwards;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-align: center;
        }

        h1 {
            color: #343a40;
            text-align: center;
            margin-bottom: 30px;
        }

        .coming-soon {
            font-size: 1.5rem;
            color: #28a745;
            text-align: center;
            font-weight: bold;
            animation: pulse 2s infinite;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-section {
            background: linear-gradient(180deg, #e8f4f8 0%, #b8d8e7 100%);
            min-height: 100vh;
            position: relative;
        }

        .organizers-section {
            background: linear-gradient(135deg, #0a1647 0%, #1a4b8c 100%);
            color: white;
            padding: 80px 0;
        }

        .dah {

            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;


            .banner-container {
                max-width: 500px;
                width: 100%;
                padding: 15px;
            }

            .banner {
                background-color: #f0f8ff;
                border-radius: 15px;
                overflow: hidden;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .banner-content {
                display: flex;
                align-items: center;
                padding: 10px;
            }

            .banner-text {
                flex-grow: 1;
                text-align: center;
                color: #00008b;
                font-weight: bold;
                font-size: 1.2rem;
                line-height: 1.4;
            }

            .banner-image {
                width: 80px;
                height: 80px;
                border-radius: 50%;
                object-fit: cover;
                margin-right: 15px;
            }
        }


        .event-details {
            background: rgba(13, 17, 71, 0.9);
            color: white;
            border-radius: 25px;
            padding: 10px 30px;
            display: inline-block;
        }

        .location-badge {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 25px;
            padding: 10px 30px;
            display: inline-block;
        }

        .register-btn {
            position: fixed;
            right: 30px;
            bottom: 30px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: #0077b6;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 24px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .register-btn:hover {
            background-color: #005b8c;
            color: white;
        }

        .section-list {
            list-style: none;
            padding-left: 0;
        }

        .section-list li {
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }

        .section-list li:before {
            content: "•";
            color: #4a90e2;
            font-size: 1.5em;
            margin-right: 10px;
        }

        .partners-section {
            background-color: #060B36;
            color: white;
            padding: 80px 0;
        }

        .partner-card {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            height: 100%;
        }

        .partner-name {
            font-size: 1.2rem;
            margin-top: 1rem;
            font-weight: 500;

            width: 100%;
        }

        .section-title {
            font-size: 3rem;
            font-weight: 600;
            margin-bottom: 4rem;
        }

        .partner-icon {
            width: 150px;
            height: 150px;
            object-fit: contain;
        }

        .why-participate {
            background-color: #060B36;
            color: white;
            padding: 80px 0;
        }

        .reason-card {
            background-color: #0F1642;
            border-radius: 15px;
            padding: 30px;
            height: 100%;
            position: relative;
            transition: transform 0.3s ease;
        }

        .reason-card:hover {
            transform: translateY(-5px);
        }

        .number-badge {
            width: 40px;
            height: 40px;
            background-color: #1E90FF;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
        }

        .contact-btn {
            background-color: white;
            color: #060B36;
            padding: 10px 25px;
            border-radius: 25px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .contact-btn:hover {
            background-color: #1E90FF;
            color: white;
            transform: translateY(-2px);
        }

        .section-badge {
            background-color: rgba(30, 144, 255, 0.1);
            color: #1E90FF;
            padding: 8px 20px;
            border-radius: 20px;
            display: inline-block;
            margin-bottom: 2rem;
        }

        .why-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 2rem;
        }


        /*    coming soon */
        .coming-soon {


            & body {
                background: linear-gradient(180deg, #000051 0%, #0000A0 100%);
                color: white;
                min-height: 100vh;
            }

            .main-container {
                background-color: rgba(0, 0, 80, 0.6);
                border-radius: 20px;
                padding: 30px;
                margin-top: 50px;
            }

            .info-card {
                background-color: rgba(0, 0, 100, 0.8);
                border-radius: 15px;
                padding: 20px;
                height: 100%;
                color: white;
            }

            .icon {
                font-size: 2rem;
                margin-bottom: 15px;
            }

            & h1 {
                font-size: 1.8rem;
                margin-bottom: 30px;
            }

            & h2 {
                font-size: 1.4rem;
                margin-bottom: 15px;
            }

            & p {
                font-size: 0.9rem;
            }
        }

        .contact-form {
            & body {
                background: linear-gradient(180deg, #87CEEB 0%, #E0F6FF 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .main-container {
                background-color: rgba(255, 255, 255, 0.1);
                border-radius: 20px;
                padding: 30px;
                backdrop-filter: blur(10px);
            }

            .info-section {
                color: #fff;
            }

            .info-item {
                margin-bottom: 20px;
            }

            .info-icon {
                background-color: #333;
                color: #fff;
                border-radius: 50%;
                width: 40px;
                height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 15px;
            }

            .form-section {
                background-color: rgba(255, 255, 255, 0.2);
                border-radius: 15px;
                padding: 20px;
            }

            .form-control {
                background-color: rgba(255, 255, 255, 0.1);
                border: 1px solid rgba(255, 255, 255, 0.3);

            }


            .btn-primary {
                background-color: #000080;
                border: none;
            }
        }

        .logo {
            position: absolute;
            top: 20px;
            left: 20px;
            max-width: 200px;
            z-index: 1000;
        }

        .hero-image {
            max-height: 350px;
            margin: auto;
        }
    </style>


</head>
<body>

<section class="hero-section pt-4">
    <img src="/contacts/public/logo.png" alt="Medical Gate of Africa Logo" class="logo">
    <div class="container py-5 mt-4">
        <div class="dah mb-4">
            <div class="banner">
                <div class="banner-content">
                    <img src="/contacts/public/dah.jpeg" alt="Dr. Mariem Mohamed Fadel Dah"
                         class="banner-image">
                    <div class="banner-text">
                        SOUS LE HAUT PATRONAGE DE<br>
                        LA PREMIERE DAME<br>
                        DR. MARIEM MOHAMED FADEL DAH
                    </div>
                </div>
            </div>
        </div>
        <h1 class="text-primary h4 mb-4 slogan">Medical Gate of Africa</h1>
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <h2 class="display-6 fw-bold mb-4">
                    Bienvenue à MEDEX 2024
                </h2>
                <p class="lead mb-5">
                    La première foire internationale de la santé en Mauritanie. un événement
                    inédit sous le thème de l’innovation médicale. Organisé par la Fédération Nationale de la Santé,
                    cet événement annuel est conçu pour catalyser le développement du secteur médical en Afrique, en
                    répondant aux défis critiques pour assurer un avenir sain à tout le continent.
                </p>
            </div>
        </div>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <div class="event-details">
                <i class="fa fa-calendar text-white"></i>
                November 22-24
            </div>
            <div class="location-badge">
                <i class="fa fa-map-marker-alt"></i>
                Nouakchott Congress Palace, Mauritania
            </div>
        </div>
    </div>
    </div>

    <!-- New Organizers Section -->
    <section class="organizers-section">
        <div class="container">
            <h2 class="display-4 text-center mb-5">Organisateurs</h2>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <p class="lead mb-4">
                        Créée en mars 2022 et affiliée à l'Union Nationale du Patronat Mauritanien (UNPM),
                        La Fédération Nationale de la Santé (FNS) est une organisation dynamique qui regroupe
                        tous les acteurs du secteur privé de la santé en Mauritanie. Composée de plus de 200
                        sociétés privées reparties dans six sections clés du secteur de la santé :
                    </p>

                    <ul class="section-list mb-5">
                        <li>Section des hôpitaux et cliniques privées</li>
                        <li>Section des pharmacies</li>
                        <li>Section des importateurs de médicaments</li>
                        <li>Section de la santé animale</li>
                        <li>Section d'équipements médicaux</li>
                        <li>Section des laboratoires</li>
                    </ul>

                    <p class="lead">
                        La fédération vise à renforcer les efforts des pouvoirs publics, et à promouvoir
                        la disponibilité généralisée des services de santé. En collaborant avec les autorités
                        et autres parties prenantes, la FNS s'engage à améliorer la qualité des soins et à
                        répondre aux besoins croissants de la population mauritanienne.
                    </p>
                </div>
            </div>
        </div>
    </section>


    <!-- Partners Section -->
    <section class="partners-section">
        <div class="container">
            <h2 class="text-center section-title">Nos partenaires</h2>

            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-3">
                    <div class="partner-card">
                        <img src="/contacts/public/logos/mr.png" alt="Partner icon" class="partner-icon">
                        <h3 class="partner-name">Ministère de la Santé</h3>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="partner-card">
                        <img src="/contacts/public/logos/mr.png" alt="Partner icon" class="partner-icon">
                        <h3 class="partner-name">Ministère du Commerce et du Tourisme</h3>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="partner-card">
                        <img src="/contacts/public/logos/eu.png" alt="Partner icon" class="partner-icon">
                        <h3 class="partner-name">Union européenne</h3>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="partner-card">
                        <img src="/contacts/public/logos/camec.png" alt="Partner icon" class="partner-icon">
                        <h3 class="partner-name">CAMEC</h3>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="partner-card">
                        <img src="/contacts/public/logos/ped.png" alt="Partner icon" class="partner-icon">
                        <h3 class="partner-name">Société Mauritanienne de Pédiatrie</h3>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="partner-card">
                        <img src="/contacts/public/logos/ordre.png" alt="Partner icon" class="partner-icon">
                        <h3 class="partner-name">Ordre National des Médecins de Mauritanie</h3>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="partner-card">
                        <img src="/contacts/public/logos/zayed.png" alt="Partner icon" class="partner-icon">
                        <h3 class="partner-name">Centre Hospitalier Cheikh Zayed</h3>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="partner-card">
                        <img src="/contacts/public/logos/logosmart.png" alt="Partner icon" class="partner-icon">
                        <h3 class="partner-name">SMART MS SA</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Previous sections remain -->

    <!-- why participate -->
    <section class="why-participate">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-4">
                    <div class="section-badge">Principales différences</div>
                    <h2 class="why-title">Pourquoi participer à l'événement ?</h2>
                    <a href="#contact" class="contact-btn">Contactez-nous</a>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="reason-card">
                        <div class="number-badge">1</div>
                        <p>MEDEX 2024 est votre occasion de présenter vos produits et solutions innovantes à un public
                            de plus de 400 millions de personnes, tout en explorant de nouveaux horizons commerciaux
                            dans le secteur médical. Explorez des innovations de pointe, partagez vos dernières avancées
                            technologiques, et faites progresser votre entreprise vers de nouveaux succès.</p>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="reason-card">
                        <div class="number-badge">2</div>
                        <p>Profitez de cette chance unique pour établir des relations durables et développer des
                            partenariats stratégiques avec des acteurs clés locaux et régionaux. MEDEX 2024 vous permet
                            de connecter avec des décideurs, des investisseurs et des professionnels de l'industrie,
                            ouvrant la voie à des collaborations fructueuses et à long terme</p>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="reason-card">
                        <div class="number-badge">3</div>
                        <p>En participant à MEDEX 2024, vous accéderez à un éventail de produits avant-gardistes et
                            rencontrerez des investisseurs prêts à explorer les possibilités qu'offre le marché
                            africain. C'est une occasion incontournable pour tous ceux qui cherchent à étendre leur
                            réseau, à acquérir de nouvelles compétences et à propulser leur entreprise vers de nouveaux
                            sommets</p>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="reason-card">
                        <div class="number-badge">4</div>
                        <p>Participez à des conférences et ateliers animés par des experts du secteur. Acquérez des
                            insights uniques sur les tendances du marché, adaptez vos produits et services pour mieux
                            répondre aux attentes locales et régionales, tout en explorant les potentialités de
                            croissance de votre entreprise.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container my-5">
        <h1 class="mb-5">Statistiques de l'Événement</h1>
        <div class="stats-container">
            <div class="stat-item">
                <div class="stat-number">+100</div>
                <div class="stat-label">Stands</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">+20</div>
                <div class="stat-label">Démonstrations en direct</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">+50</div>
                <div class="stat-label">Pays participants</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">+2000</div>
                <div class="stat-label">Visiteurs</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">+40</div>
                <div class="stat-label">Spécialités médicales</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">+200</div>
                <div class="stat-label">B2B</div>
            </div>
        </div>
    </div>

    <section class="program">

        <h1 class="mt-5">Programme des Conférences</h1>
        <p class="coming-soon">Bientôt disponible</p>
    </section>

    <section class="coming-soon">
        <div class="container main-container">
            <h1 class="text-center">Nous vous attendons à Nouakchott pour trois jours de découvertes, de networking et
                de développement stratégique</h1>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="info-card">
                        <div class="icon text-center">&#10010;</div>
                        <h2 class="text-center">Inscrivez-vous</h2>
                        <p>Rejoignez-nous pour le plus grand événement médical de l'année en Afrique de l'Ouest ! MEDEX
                            2024 rassemblera les leaders du secteur, les innovations de pointe, et un réseau mondial
                            d'experts. Inscrivez-vous dès maintenant pour être au cœur de la révolution médicale !</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-card">
                        <div class="icon text-center">&#9742;</div>
                        <h2 class="text-center">Votre guide pour MEDEX 2024</h2>
                        <p>Des questions ou besoin d'informations sur MEDEX 2024 ? Notre équipe est à votre disposition
                            pour vous fournir tous les détails nécessaires et vous accompagner dans la préparation de
                            votre participation. Contactez-nous sans hésitation</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-card">
                        <div class="icon text-center">&#128197;</div>
                        <h2 class="text-center">Préparez Votre Visite</h2>
                        <p>Nous travaillons actuellement sur cette section pour vous offrir toutes les informations
                            nécessaires afin de bien préparer votre visite. Elle sera disponible très bientôt. Merci de
                            votre patience !</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="contact-form mt-5">
        <div class="container main-container">
            <div class="row">
                <div class="col-md-6 info-section text-dark pt-5">
                    <div class="info-item d-flex align-items-center ">
                        <div class="info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h3>Email</h3>
                            <p>contact@medex.mr</p>
                        </div>
                    </div>
                    <div class="info-item d-flex align-items-center">
                        <div class="info-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div>
                            <h3>Téléphone</h3>
                            <p>+222 36293639 / +222 26212622 / +222 46420364</p>
                        </div>
                    </div>
                    <div class="info-item d-flex align-items-center">
                        <div class="info-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h3>Adresse</h3>
                            <p>Rue Sidi Bouna Ould Sidi ZRA 571 TEVRAGH ZEINA Nouakchott-Mauritanie</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 form-section">
                    <h2 class="mb-4">Nous contacter</h2>
                    <form>

                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Prénom *" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Nom">
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Email*" required>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" rows="4" placeholder="Message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mx-auto">Envoyer un message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>

