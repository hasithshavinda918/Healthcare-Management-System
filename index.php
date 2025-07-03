<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>GreenLife Wellness Center</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        /* Reset & base */
        * {
            box-sizing: border-box;
            margin: 0; 
            padding: 0;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: #555879;
            color: #333;
            line-height: 1.7;
            overflow-x: hidden;
        }
        
        a {
            text-decoration: none;
            color: inherit;
        }

       

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-30px) rotate(0.5deg); }
            66% { transform: translateY(20px) rotate(-0.5deg); }
        }

        /* Navbar */
        nav {
            background: #555879;
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }
        
       
        
        nav .logo {
            font-weight: 700;
            font-size: 1.8em;
            letter-spacing: 2px;
            background: linear-gradient(45deg, #00f5ff, #00c9ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: glow 2s ease-in-out infinite alternate;
        }

        @keyframes glow {
            from { filter: drop-shadow(0 0 5px rgba(0, 245, 255, 0.5)); }
            to { filter: drop-shadow(0 0 20px rgba(0, 245, 255, 0.8)); }
        }
        
        nav ul {
            list-style: none;
            display: flex;
            gap: 35px;
        }
        
        nav ul li {
            font-weight: 500;
            position: relative;
            transition: all 0.3s ease;
        }
        
        nav ul li::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(45deg, #00f5ff, #00c9ff);
            transition: width 0.3s ease;
        }
        
        nav ul li:hover::after {
            width: 100%;
        }
        
        nav ul li:hover {
            transform: translateY(-3px);
            filter: drop-shadow(0 5px 10px rgba(0, 0, 0, 0.3));
        }

        /* Hero Section */
        .hero {
            background: 
                linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6)),
                url('bg123.jpg') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(102, 126, 234, 0.8), rgba(118, 75, 162, 0.8));
            animation: pulse 4s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 0.8; }
            50% { opacity: 0.6; }
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 900px;
            padding: 0 20px;
        }
        
        .hero h1 {
            font-size: 4em;
            font-weight: 700;
            margin-bottom: 20px;
            background: linear-gradient(45deg, #ffffff, #00f5ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: slideInDown 1s ease-out;
        }

        .hero p {
            font-size: 1.3em;
            margin-bottom: 30px;
            animation: slideInUp 1s ease-out 0.5s both;
            opacity: 0.9;
        }

        .cta-button {
            display: inline-block;
            background: linear-gradient(45deg, #00f5ff, #00c9ff);
            color: white;
            padding: 15px 35px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1em;
            transition: all 0.3s ease;
            animation: slideInUp 1s ease-out 1s both;
            box-shadow: 0 10px 30px rgba(0, 245, 255, 0.4);
        }

        .cta-button:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 20px 40px rgba(0, 245, 255, 0.6);
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-100px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(100px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 80px 20px;
            position: relative;
        }

        /* Sections */
        section {
            margin-bottom: 100px;
            position: relative;
        }
        
        section h2 {
            color: #98A1BC;
            margin-bottom: 50px;
            font-size: 2.5em;
            font-weight: 700;
            text-align: center;
            position: relative;
            background: white;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        section h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-radius: 2px;
        }

        /* Services Grid */
        .services {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
        }
        
        .service-item {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 40px 30px;
            border-radius: 20px;
            text-align: center;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .service-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.6s ease;
        }

        .service-item:hover::before {
            left: 100%;
        }
        
        .service-item:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
            background: rgba(255, 255, 255, 0.15);
        }
        
        .service-item h3 {
            margin-bottom: 20px;
            color:rgb(0, 0, 0);
            font-size: 1.4em;
            font-weight: 600;
        }
        
        .service-item p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.1em;
            line-height: 1.8;
        }

        /* About Section */
        #about {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 60px 40px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            text-align: center;
        }

        #about p {
            font-size: 1.2em;
            color: rgba(0, 0, 0, 0.9);
            line-height: 2;
            max-width: 800px;
            margin: 0 auto;
        }

        /* Contact */
        #contact {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
        }

        .contact-info {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 40px;
            border-radius: 20px;
            color: white;
        }
        
        .contact-info p {
            margin-bottom: 20px;
            font-size: 1.1em;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .contact-info p::before {
            content: '📍';
            font-size: 1.2em;
        }

        .contact-info p:nth-child(2)::before {
            content: '📞';
        }

        .contact-info p:nth-child(3)::before {
            content: '✉️';
        }
        
        form.contact-form {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 40px;
            border-radius: 20px;
        }
        
        form.contact-form label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: white;
            font-size: 1.1em;
        }
        
        form.contact-form input,
        form.contact-form textarea {
            width: 100%;
            padding: 15px 20px;
            margin-bottom: 25px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 15px;
            font-size: 1em;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        form.contact-form input::placeholder,
        form.contact-form textarea::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        form.contact-form input:focus,
        form.contact-form textarea:focus {
            outline: none;
            border-color: #00f5ff;
            box-shadow: 0 0 20px rgba(0, 245, 255, 0.3);
            background: rgba(255, 255, 255, 0.15);
        }
        
        form.contact-form button {
            background: linear-gradient(45deg, #00f5ff, #00c9ff);
            color: white;
            border: none;
            padding: 15px 35px;
            font-size: 1.1em;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            width: 100%;
            box-shadow: 0 10px 30px rgba(0, 245, 255, 0.4);
        }
        
        form.contact-form button:hover:not(:disabled) {
            transform: translateY(-3px);
            box-shadow: 0 20px 40px rgba(0, 245, 255, 0.6);
        }

        form.contact-form button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 40px 20px;
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(20px);
            color: rgba(255, 255, 255, 0.8);
            font-size: 1em;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Responsive */
        @media(max-width: 768px) {
            .hero h1 {
                font-size: 2.5em;
            }
            
            nav {
                padding: 15px 20px;
            }
            
            nav ul {
                gap: 20px;
            }
            
            nav .logo {
                font-size: 1.4em;
            }
            
            .container {
                padding: 40px 15px;
            }
            
            section h2 {
                font-size: 2em;
            }
            
            #contact {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            
            .services {
                grid-template-columns: 1fr;
            }
        }

        @media(max-width: 480px) {
            .hero h1 {
                font-size: 2em;
            }
            
            .hero p {
                font-size: 1.1em;
            }
            
            nav ul {
                gap: 15px;
                font-size: 0.9em;
            }
        }

        /* Scroll animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .service-item {
            animation: fadeInUp 0.6s ease-out;
        }

        .service-item:nth-child(1) { animation-delay: 0.1s; }
        .service-item:nth-child(2) { animation-delay: 0.2s; }
        .service-item:nth-child(3) { animation-delay: 0.3s; }
        .service-item:nth-child(4) { animation-delay: 0.4s; }
        .service-item:nth-child(5) { animation-delay: 0.5s; }
    </style>
</head>
<body>

    <nav>
        <div class="logo">GreenLife Wellness Center</div>
        <ul>
            <li><a href="#hero">Home</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </nav>
        <section id="hero">
    <div class="hero">
        <div class="hero-content">
            <h1>Welcome to GreenLife Wellness Center</h1>
            <p>Your Path to Holistic Health & Well-being Through Traditional and Modern Practices</p>
            <a href="#services" class="cta-button">Explore Our Services</a>
        </div>
    </div>
    </section>

    <div class="container">

        <section id="services">
            <h2>Our Services</h2>
            <div class="services">
                <div class="service-item">
                    <h3>Ayurvedic Therapy</h3>
                    <p>Traditional natural healing to balance body and mind through ancient wisdom and modern applications.</p>
                </div>
                <div class="service-item">
                    <h3>Yoga & Meditation Classes</h3>
                    <p>Enhance flexibility, strength, and mental clarity with guided sessions led by certified instructors.</p>
                </div>
                <div class="service-item">
                    <h3>Nutrition & Diet Consultation</h3>
                    <p>Personalized diet plans and nutritional guidance to meet your specific health goals and lifestyle.</p>
                </div>
                <div class="service-item">
                    <h3>Physiotherapy</h3>
                    <p>Professional rehabilitation and pain relief through expert physiotherapy and movement therapy.</p>
                </div>
                <div class="service-item">
                    <h3>Massage Therapy</h3>
                    <p>Relax and rejuvenate with therapeutic massages designed to restore balance and vitality.</p>
                </div>
            </div>
        </section>

        <section id="about">
            <h2>About GreenLife</h2>
            <p>GreenLife Wellness Center, based in Colombo, is dedicated to promoting holistic wellness through a harmonious blend of traditional and modern practices. Our team of expert therapists and wellness consultants are committed to helping you achieve optimal health in a supportive, peaceful, and inspiring environment that nurtures both body and soul.</p>
        </section>

        <section id="contact">
            <h2 style="grid-column: 1 / -1; margin-bottom: 30px;">Contact Us</h2>

            <div class="contact-info">
                <p><strong>123 Wellness Ave, Colombo, Sri Lanka</strong></p>
                <p><strong>+94 11 234 5678</strong></p>
                <p><strong>contact@greenlifewellness.lk</strong></p>
            </div>

            <form class="contact-form" action="#" method="post">
                <label for="name">Name</label>
                <input id="name" type="text" name="name" placeholder="Your full name" required />

                <label for="email">Email</label>
                <input id="email" type="email" name="email" placeholder="your.email@example.com" required />

                <label for="message">Message</label>
                <textarea id="message" name="message" placeholder="Tell us how we can help you on your wellness journey..." rows="5" required></textarea>

                <button type="submit" disabled title="Form submission not implemented">Send Message</button>
            </form>
        </section>

    </div>

    <footer>
        &copy; 2025 GreenLife Wellness Center. All rights reserved. | Crafted with care for your wellness journey.
    </footer>

</body>
</html>