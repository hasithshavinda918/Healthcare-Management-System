# 🌿 GreenLife Wellness Center - Web Application

A modern, responsive web application for a holistic wellness center offering traditional and contemporary health services. Built with PHP, MySQL, and modern web technologies.

![GreenLife Wellness Center](https://img.shields.io/badge/Status-Active-green)
![PHP](https://img.shields.io/badge/PHP-7.4+-blue)
![MySQL](https://img.shields.io/badge/Database-MySQL-orange)
![Responsive](https://img.shields.io/badge/Design-Responsive-purple)

## 🏥 About GreenLife Wellness Center

GreenLife Wellness Center is a comprehensive wellness platform that bridges traditional healing practices with modern healthcare approaches. Located in Colombo, Sri Lanka, we offer a harmonious blend of Ayurvedic therapy, yoga, nutrition consulting, physiotherapy, and therapeutic massage services.

## ✨ Features

### 🎨 Frontend Features
- **Modern UI/UX**: Clean, glassmorphism design with smooth animations
- **Responsive Design**: Fully optimized for desktop, tablet, and mobile devices
- **Interactive Elements**: Hover effects, smooth scrolling, and dynamic animations
- **Service Showcase**: Detailed presentation of wellness services
- **Contact Form**: User-friendly contact interface
- **Accessibility**: WCAG compliant design principles

### ⚙️ Backend Features
- **User Management**: Registration, login, and profile management
- **Role-Based Access**: Admin, Therapist, and User dashboards
- **Appointment System**: Booking and management functionality
- **Database Integration**: MySQL database for data persistence
- **Session Management**: Secure user session handling
- **Authentication**: Secure login system with password protection

## 🛠️ Tech Stack

- **Frontend**: HTML5, CSS3, JavaScript, Responsive Design
- **Backend**: PHP 7.4+
- **Database**: MySQL
- **Server**: Apache (XAMPP)
- **Styling**: Modern CSS with Glassmorphism effects
- **Typography**: Google Fonts (Poppins)
- **Icons**: Unicode Emojis & CSS Icons

## 📁 Project Structure

```
greenlife_webapp/
├── index.php              # Landing page
├── login.php             # User login page
├── register.php          # User registration
├── logout.php            # Logout functionality
├── admin_dashboard.php   # Admin panel
├── therapist_dashboard.php # Therapist interface
├── user_dashboard.php    # User dashboard
├── db_connect.php        # Database connection
├── database.sql          # Database schema
├── bg123.jpg            # Background image
└── README.md            # Project documentation
```

## 🚀 Installation & Setup

### Prerequisites
- XAMPP (or similar LAMP/WAMP stack)
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web browser (Chrome, Firefox, Safari, Edge)

### Installation Steps

1. **Clone the Repository**
   ```bash
   git clone https://github.com/hasithshavinda918/greenlife_webapp.git
   cd greenlife_webapp
   ```

2. **Setup XAMPP**
   - Start Apache and MySQL services
   - Copy project folder to `htdocs` directory

3. **Database Setup**
   - Open phpMyAdmin (http://localhost/phpmyadmin)
   - Create a new database named `greenlife_db`
   - Import the `database.sql` file

4. **Configure Database Connection**
   - Open `db_connect.php`
   - Update database credentials if needed
   ```php
   $host = 'localhost';
   $username = 'root';
   $password = '';
   $database = 'greenlife_db';
   ```

5. **Access the Application**
   - Open browser and navigate to `http://localhost/greenlife_webapp`

## 🎯 Usage

### For Visitors
- Browse wellness services
- Learn about GreenLife center
- Contact the center via contact form
- Register for an account

### For Users
- Login to personal dashboard
- Book appointments
- View service history
- Manage profile

### For Therapists
- Access therapist dashboard
- Manage appointments
- View client information
- Update availability

### For Admins
- Full system administration
- User management
- Appointment oversight
- System analytics

## 🌟 Services Offered

1. **🌱 Ayurvedic Therapy**
   - Traditional natural healing
   - Body and mind balance
   - Ancient wisdom with modern applications

2. **🧘 Yoga & Meditation Classes**
   - Flexibility and strength enhancement
   - Mental clarity improvement
   - Certified instructor guidance

3. **🥗 Nutrition & Diet Consultation**
   - Personalized diet plans
   - Nutritional guidance
   - Health goal optimization

4. **🏃 Physiotherapy**
   - Professional rehabilitation
   - Pain relief therapy
   - Movement therapy expertise

5. **💆 Massage Therapy**
   - Therapeutic relaxation
   - Balance restoration
   - Vitality enhancement

## 🔧 Configuration

### Environment Variables
Create a `.env` file for sensitive configurations:
```env
DB_HOST=localhost
DB_USERNAME=root
DB_PASSWORD=
DB_NAME=greenlife_db
APP_ENV=development
```

### Security Features
- Password hashing
- SQL injection prevention
- XSS protection
- Session security
- Input validation

## 🤝 Contributing

We welcome contributions to improve GreenLife Wellness Center! Here's how you can help:

1. **Fork the Repository**
2. **Create Feature Branch** (`git checkout -b feature/AmazingFeature`)
3. **Commit Changes** (`git commit -m 'Add some AmazingFeature'`)
4. **Push to Branch** (`git push origin feature/AmazingFeature`)
5. **Open Pull Request**

### Development Guidelines
- Follow PSR-4 coding standards
- Write clean, documented code
- Test thoroughly before submitting
- Maintain responsive design principles

## 📱 Responsive Design

The application is fully responsive and optimized for:
- **Desktop**: 1200px and above
- **Tablet**: 768px - 1199px
- **Mobile**: Below 768px

## 🎨 Design Features

- **Glassmorphism UI**: Modern frosted glass effect
- **Smooth Animations**: CSS keyframe animations
- **Color Scheme**: Professional wellness-themed palette
- **Typography**: Clean, readable font hierarchy
- **Interactive Elements**: Hover effects and transitions

## 🐛 Known Issues

- Contact form requires backend implementation
- File upload features pending
- Payment gateway integration needed
- Email notification system to be added

## 🔮 Future Enhancements

- [ ] Online payment integration
- [ ] Real-time appointment notifications
- [ ] Mobile app development
- [ ] Advanced analytics dashboard
- [ ] Multi-language support
- [ ] API development
- [ ] Cloud deployment

## 📞 Support & Contact

For support, feature requests, or general inquiries:

- **Website**: [GreenLife Wellness Center](http://localhost/greenlife_webapp)
- **Email**: contact@greenlifewellness.lk
- **Phone**: +94 11 234 5678
- **Address**: 123 Wellness Ave, Colombo, Sri Lanka

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- **Design Inspiration**: Modern wellness industry standards
- **Typography**: Google Fonts Poppins family
- **Icons**: Unicode emoji set
- **Community**: PHP and web development community
- **Testing**: Local XAMPP development environment

## 📊 Project Status

- ✅ Frontend Development: Complete
- ✅ Backend Architecture: Complete
- ✅ Database Design: Complete
- ✅ User Authentication: Complete
- ⏳ Advanced Features: In Progress
- ⏳ Testing: In Progress
- ⏳ Documentation: In Progress

---

**Built with ❤️ for holistic wellness and modern healthcare solutions**

*Last updated: September 3, 2025*
