<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>HolisticCare Professional Platform | Enterprise Healthcare Management System</title>
    <meta name="description" content="Advanced healthcare management platform combining traditional healing with modern medical practice. Enterprise-grade patient management, appointment scheduling, and integrated wellness services for healthcare professionals." />
    <meta name="keywords" content="healthcare management system, patient management platform, medical practice software, wellness center management, enterprise healthcare solution, clinical management system" />
    <meta name="author" content="HolisticCare Professional Platform" />
    <meta name="robots" content="index, follow" />
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="HolisticCare Professional Platform - Enterprise Healthcare Management" />
    <meta property="og:description" content="Comprehensive healthcare management system designed for modern medical practices and wellness centers." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://holisticcare-platform.com" />
    <meta property="og:image" content="bg123.jpg" />
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="HolisticCare Professional Platform" />
    <meta name="twitter:description" content="Enterprise-grade healthcare management solution for modern medical practices." />
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
        <div class="logo">HolisticCare Professional Platform</div>
        <ul>
            <li><a href="#hero">Home</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="login.php">Portal Login</a></li>
        </ul>
    </nav>
        <section id="hero">
    <div class="hero">
        <div class="hero-content">
            <h1>HolisticCare Professional Platform</h1>
            <p>Enterprise-grade healthcare management system designed for modern medical practices. Seamlessly integrate patient care, appointment scheduling, and wellness services with cutting-edge technology and professional-grade security.</p>
            <a href="#services" class="cta-button">Explore Platform Features</a>
        </div>
    </div>
    </section>

    <div class="container">

        <section id="services">
            <h2>Platform Features & Capabilities</h2>
            <div class="services">
                <div class="service-item">
                    <h3>� Patient Management System</h3>
                    <p>Comprehensive electronic health records (EHR) with advanced patient tracking, medical history management, treatment planning, and secure data storage compliant with healthcare regulations.</p>
                </div>
                <div class="service-item">
                    <h3>📅 Advanced Appointment Scheduler</h3>
                    <p>Intelligent scheduling system with conflict resolution, automated reminders, resource allocation, and multi-provider calendar management designed for busy healthcare practices.</p>
                </div>
                <div class="service-item">
                    <h3>📊 Clinical Analytics & Reporting</h3>
                    <p>Professional-grade analytics dashboard providing insights into patient outcomes, treatment effectiveness, operational efficiency, and comprehensive regulatory compliance reporting.</p>
                </div>
                <div class="service-item">
                    <h3>🔒 Enterprise Security & Compliance</h3>
                    <p>HIPAA-compliant security infrastructure with role-based access control, data encryption, audit trails, and comprehensive security monitoring for healthcare data protection.</p>
                </div>
                <div class="service-item">
                    <h3>🌐 Multi-Role Dashboard System</h3>
                    <p>Specialized interfaces for administrators, healthcare providers, and patients with customized workflows, real-time notifications, and seamless inter-role communication capabilities.</p>
                </div>
            </div>
        </section>

        <section id="about">
            <h2>About HolisticCare Professional Platform</h2>
            <p>HolisticCare Professional Platform represents the next generation of healthcare management systems, specifically engineered for modern medical practices, wellness centers, and integrated healthcare facilities. Our enterprise-grade solution combines robust patient management capabilities with advanced clinical workflows, delivering a comprehensive platform that supports healthcare professionals in providing exceptional patient care.</p>
            
            <p style="margin-top: 30px;">Built on a foundation of security, scalability, and user-centric design, our platform integrates seamlessly with existing healthcare infrastructure while providing innovative features for patient engagement, clinical decision support, and operational efficiency. Whether managing a single practice or a multi-location healthcare organization, HolisticCare adapts to your unique workflows and regulatory requirements, ensuring optimal performance and compliance at every level.</p>
        </section>

        <section id="contact">
            <h2 style="grid-column: 1 / -1; margin-bottom: 30px;">Contact Us</h2>

            <div class="contact-info">
                <h3 style="color: #00f5ff; margin-bottom: 25px; font-size: 1.5em;">Contact Our Professional Team</h3>
                <p><strong>🏢 HolisticCare Professional Platform</strong></p>
                <p><strong>📍 Healthcare Technology Center, Colombo 07, Sri Lanka</strong></p>
                <p><strong>📞 Enterprise Support: +94 11 234 5678</strong></p>
                <p><strong>✉️ contact@holisticcare-platform.com</strong></p>
                
                <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.2);">
                    <h4 style="color: #00c9ff; margin-bottom: 15px;">Professional Support Hours</h4>
                    <p style="margin-bottom: 8px;">🕒 Monday - Friday: 8:00 AM - 6:00 PM</p>
                    <p style="margin-bottom: 8px;">🕒 Saturday: 9:00 AM - 4:00 PM</p>
                    <p style="margin-bottom: 8px;">🕒 Sunday: Emergency Support Only</p>
                </div>
                
                <div style="margin-top: 25px;">
                    <h4 style="color: #00c9ff; margin-bottom: 15px;">Technical Support</h4>
                    <p>� 24/7 System Support: +94 11 800 0000</p>
                    <p>💬 Live Chat: Available 24/7</p>
                </div>
            </div>

            <form class="contact-form" action="#" method="post">
                <label for="name">Name</label>
                <input id="name" type="text" name="name" placeholder="Your full name" required />

                <label for="email">Email</label>
                <input id="email" type="email" name="email" placeholder="your.email@example.com" required />

                <label for="message">Project Requirements</label>
                <textarea id="message" name="message" placeholder="Describe your healthcare management needs, number of users, specific features required, and integration requirements..." rows="5" required></textarea>

                <button type="submit" disabled title="Contact form requires backend implementation">Request Enterprise Demo</button>
            </form>
        </section>

    </div>

    <footer>
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px; margin-bottom: 20px;">
                <div>
                    <h3 style="color: #00f5ff; margin-bottom: 10px;">HolisticCare Professional Platform</h3>
                    <p style="margin-bottom: 5px;">🏢 Healthcare Technology Center</p>
                    <p style="margin-bottom: 5px;">📞 Enterprise: +94 11 234 5678</p>
                    <p>✉️ contact@holisticcare-platform.com</p>
                </div>
                
                <div style="text-align: center;">
                    <p style="margin-bottom: 10px;"><strong>Professional Network</strong></p>
                    <div style="display: flex; gap: 15px; justify-content: center;">
                        <span style="font-size: 24px; cursor: pointer;" title="LinkedIn">�</span>
                        <span style="font-size: 24px; cursor: pointer;" title="Professional Network">🌐</span>
                        <span style="font-size: 24px; cursor: pointer;" title="Support Portal">�️</span>
                        <span style="font-size: 24px; cursor: pointer;" title="Documentation">�</span>
                    </div>
                </div>
            </div>
            
            <div style="border-top: 1px solid rgba(255,255,255,0.2); padding-top: 20px; text-align: center;">
                <p>&copy; 2025 HolisticCare Professional Platform. All rights reserved. | Enterprise Healthcare Management Solutions</p>
                <p style="margin-top: 10px; font-size: 0.9em; opacity: 0.8;">HIPAA Compliant | ISO 27001 Certified | SOC 2 Type II Certified | Enterprise Grade Security</p>
            </div>
        </div>
    </footer>

</body>
</html>