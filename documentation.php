<?php
// documentation.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Woolify Documentation</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- AOS Animations -->
    <link href="https://unpkg.com/aos@next/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <style>
        body { font-family: 'Inter', 'Poppins', sans-serif; background: #F9FAF9; }
        .brand-gradient { background: linear-gradient(90deg, #5F975F 0%, #FFD700 100%); }
        .code-block {
            background: #23272e;
            color: #f8f8f2;
            font-family: 'Fira Mono', 'Consolas', 'Menlo', monospace;
            font-size: 0.95rem;
            border-radius: 0.5rem;
            padding: 1rem;
            margin: 0.5rem 0 1.5rem 0;
            overflow-x: auto;
        }
        .faq-chevron { transition: transform 0.3s; }
        .faq-q:hover { background: #F3F7F3; text-decoration: underline; }
        .shadow-card { box-shadow: 0 4px 24px 0 rgba(95,151,95,0.07), 0 1.5px 6px 0 rgba(39,60,117,0.04); }
        .navbar-blur { backdrop-filter: blur(12px); background: rgba(255,255,255,0.92);}
        .section-card { background: #fff; border-radius: 1.25rem; box-shadow: 0 4px 24px 0 rgba(95,151,95,0.07), 0 1.5px 6px 0 rgba(39,60,117,0.04);}
        .api-label { color: #5F975F; font-weight: 600; font-size: 0.95rem; }
        .api-key { color: #FFD700; font-family: 'Fira Mono', monospace; }
    </style>
</head>
<body class="bg-[#F9FAF9] min-h-screen flex flex-col">
    <!-- Background Video -->
    <video class="fixed top-0 left-0 w-full h-full object-cover  z-0" autoplay loop muted playsinline>
        <source src="./assets/videos/sheep5.mp4" type="video/mp4">
    </video>
    <!-- Navbar -->
    <nav class="navbar-blur fixed top-0 left-0 w-full z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4">
            <a href="index.php" class="flex items-center space-x-3">
                <img src="public/assets/images/logo.png" alt="Woolify" class="h-9 w-9 rounded-2xl">
                <span class="text-2xl font-bold bg-gradient-to-r from-primary-600 to-primary-400 bg-clip-text text-transparent" style="font-family: Poppins, Inter, sans-serif;">Woolify</span>
            </a>
            <div class="hidden md:flex items-center space-x-8">
                <a href="index.php#journey" class="text-gray-700 hover:text-primary-600 font-medium transition">Journey</a>
                <a href="index.php#features" class="text-gray-700 hover:text-primary-600 font-medium transition">Features</a>
                <a href="index.php#impact" class="text-gray-700 hover:text-primary-600 font-medium transition">Impact</a>
                <a href="documentation.php" class="text-primary-700 font-semibold border-b-2 border-primary-600 pb-1">Documentation</a>
                <a href="login.php" class="text-primary-600 font-medium hover:text-primary-700 transition">Login</a>
                <a href="register.php" class="ml-2 px-5 py-2 rounded-xl bg-primary-600 text-white font-semibold hover:bg-primary-700 transition">Get Started</a>
            </div>
            <!-- Hamburger for mobile -->
            <button id="nav-toggle" class="md:hidden text-primary-600 focus:outline-none">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
        <div id="mobile-menu" class="md:hidden hidden px-6 pb-4">
            <a href="index.php#journey" class="block py-2 text-gray-700 hover:text-primary-600 font-medium">Journey</a>
            <a href="index.php#features" class="block py-2 text-gray-700 hover:text-primary-600 font-medium">Features</a>
            <a href="index.php#impact" class="block py-2 text-gray-700 hover:text-primary-600 font-medium">Impact</a>
            <a href="documentation.php" class="block py-2 text-primary-700 font-semibold">Documentation</a>
            <a href="login.php" class="block py-2 text-primary-600 font-medium">Login</a>
            <a href="register.php" class="block py-2 mt-2 rounded-xl bg-primary-600 text-white font-semibold text-center">Get Started</a>
        </div>
    </nav>
    <main class="flex-1 pt-32 pb-16 w-full relative z-10">
        <!-- About Section -->
        <section class="section-card px-4 md:px-12 py-10 mb-12 text-center shadow-card max-w-5xl mx-auto" data-aos="fade-up">
            <div class="flex flex-col items-center justify-center">
                <div class="mb-4">
                    <svg width="48" height="48" fill="none" viewBox="0 0 48 48"><circle cx="24" cy="24" r="24" fill="#F3F7F3"/><path d="M16 32c0-4 4-8 8-8s8 4 8 8" stroke="#5F975F" stroke-width="2" stroke-linecap="round"/><circle cx="24" cy="20" r="4" stroke="#FFD700" stroke-width="2"/></svg>
                </div>
                <h1 class="text-4xl font-extrabold text-primary-700 mb-2" style="font-family: Poppins, Inter, sans-serif;">Welcome to Woolify Documentation</h1>
                <p class="text-lg text-gray-700 max-w-2xl mx-auto">Woolify is a modern, transparent, and sustainable wool supply chain platform for Indian farmers, producers, and retailers. We empower users with real-time tracking, AI-powered wool grading, and seamless communication across the supply chain.</p>
            </div>
        </section>
        <!-- API Documentation Section -->
        <section class="grid md:grid-cols-2 gap-8 mb-12 max-w-7xl mx-auto px-4 md:px-12">
            <!-- Gemini API Card -->
            <div class="section-card px-7 py-8 shadow-card" data-aos="fade-up" data-aos-delay="100">
                <h2 class="text-2xl font-bold text-primary-700 mb-3 flex items-center gap-2"><span>Gemini AI API</span> <span class="text-xs bg-primary-100 text-primary-700 px-2 py-1 rounded">Google AI</span></h2>
                <div class="mb-2"><span class="api-label">Endpoint:</span> <span class="api-key">https://generativelanguage.googleapis.com/v1/models/gemini-1.5-flash:generateContent</span></div>
                <div class="mb-2"><span class="api-label">Method:</span> <span class="api-key">POST</span></div>
                <div class="mb-2"><span class="api-label">Headers:</span> <span class="api-key">Content-Type: application/json</span></div>
                <div class="mb-2"><span class="api-label">Use:</span> Powering the floating AI chatbot for text and image-based wool grading and Q&A</div>
                <div class="mb-2"><span class="api-label">Request Example:</span></div>
                <pre class="code-block">{
  "contents": [
    {
      "role": "user",
      "parts": [
        { "text": "How can I improve wool quality?" }
      ]
    }
  ]
}</pre>
                <div class="mb-2"><span class="api-label">Response Example:</span></div>
                <pre class="code-block">{
  "candidates": [
    {
      "content": {
        "parts": [
          { "text": "To improve wool quality, focus on..." }
        ]
      }
    }
  ]
}</pre>
            </div>
            <!-- Newsletter API Card -->
            <div class="section-card px-7 py-8 shadow-card" data-aos="fade-up" data-aos-delay="200">
                <h2 class="text-2xl font-bold text-primary-700 mb-3 flex items-center gap-2"><span>Newsletter Subscription API</span></h2>
                <div class="mb-2"><span class="api-label">Endpoint:</span> <span class="api-key">api/newsletter_subscribe.php</span></div>
                <div class="mb-2"><span class="api-label">Method:</span> <span class="api-key">POST</span></div>
                <div class="mb-2"><span class="api-label">Params:</span> <span class="api-key">email (string, required)</span></div>
                <div class="mb-2"><span class="api-label">Response:</span> <span class="api-key">{ success: true/false, message: string }</span></div>
                <div class="mb-2"><span class="api-label">Use:</span> Subscribes user and sends confirmation/news emails via Gmail SMTP</div>
                <div class="mb-2"><span class="api-label">Request Example:</span></div>
                <pre class="code-block">POST /api/newsletter_subscribe.php
Content-Type: application/x-www-form-urlencoded

email=someone@email.com</pre>
                <div class="mb-2"><span class="api-label">Response Example:</span></div>
                <pre class="code-block">{
  "success": true,
  "message": "Thank you for subscribing! Please check your email."
}</pre>
            </div>
        </section>
        <!-- FAQ Section -->
        <section class="section-card px-4 md:px-12 py-8 shadow-card max-w-5xl mx-auto" data-aos="fade-up" data-aos-delay="300">
            <h2 class="text-2xl font-bold text-primary-700 mb-6 text-center">Frequently Asked Questions</h2>
            <div id="faq-list" class="max-w-2xl mx-auto space-y-4">
                <?php
                $faqs = [
                    ["What is Woolify?", "Woolify is a platform for transparent, sustainable wool supply chain management, offering AI-powered tools for farmers and producers."],
                    ["How does the AI chatbot work?", "The chatbot uses Google Gemini AI to answer wool-related questions and grade wool photos for quality and price estimation."],
                    ["How do I subscribe to the newsletter?", "Enter your email in the newsletter form at the bottom of the homepage and click subscribe. You'll receive a confirmation and news updates."],
                    ["Is my data secure?", "Yes, Woolify uses secure protocols and does not share your data with third parties."],
                    ["Can I use Woolify on mobile?", "Absolutely! Woolify is fully responsive and works on all modern devices."],
                    ["How do I contact support?", "Email us at <a href='mailto:support@woolify.com' class='text-primary-600 underline'>support@woolify.com</a>."],
                ];
                foreach ($faqs as $i => $faq) {
                    echo '<div class="faq-item transition-all duration-300 bg-white rounded-xl shadow-md hover:shadow-xl hover:scale-[1.02]">';
                    echo '<button type="button" class="faq-q w-full flex justify-between items-center focus:outline-none px-6 py-4 text-lg font-semibold text-left rounded-xl transition-colors" onclick="toggleFaq(this)">' . htmlspecialchars($faq[0]) . '<svg class="faq-chevron w-5 h-5 ml-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg></button>';
                    echo '<div class="faq-a hidden px-6 pb-4 text-gray-700 text-base transition-all duration-300">' . $faq[1] . '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </section>
    </main>
    <!-- Footer -->
    <footer class="relative bg-gray-900 text-white overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-[0.03]">
            <div class="absolute inset-0" style="background-image: radial-gradient(rgba(255,255,255,0.1) 1px, transparent 1px); background-size: 24px 24px;"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <!-- Main Footer Content -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 py-16">
                <!-- Company Info -->
                <div class="space-y-6">
                    <div class="flex items-center space-x-3">
                        <img src="public/assets/images/logo.png" alt="Woolify" class="h-8 w-auto rounded-3xl">
                        <span class="text-2xl font-bold">Woolify</span>
                    </div>
                    <p class="text-gray-400 text-sm">
                        Revolutionizing wool supply chain management with transparency and sustainability at its core.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <span class="sr-only">LinkedIn</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <span class="sr-only">Twitter</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <span class="sr-only">GitHub</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-6">Quick Links</h3>
                    <ul class="space-y-4">
                        <li>
                            <a href="#features" class="text-gray-400 hover:text-white transition-colors">Features</a>
                        </li>
                        <li>
                            <a href="#about" class="text-gray-400 hover:text-white transition-colors">About Us</a>
                        </li>
                        <li>
                            <a href="#contact" class="text-gray-400 hover:text-white transition-colors">Contact</a>
                        </li>
                        <li>
                            <a href="login.php" class="text-gray-400 hover:text-white transition-colors">Login</a>
                        </li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="text-lg font-semibold mb-6">Contact Us</h3>
                    <ul class="space-y-4">
                        <li class="flex items-center text-gray-400">
                            <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            support@woolify.com
                        </li>
                        <li class="flex items-center text-gray-400">
                            <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            +1 (555) 123-4567
                        </li>
                        <li class="flex items-center text-gray-400">
                            <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            123 Wool Street, Farm City
                        </li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div>
                    <h3 class="text-lg font-semibold mb-6">Stay Updated</h3>
                    <p class="text-gray-400 text-sm mb-4">Subscribe to our newsletter for the latest updates and insights.</p>
                    <form class="space-y-4">
                        <div class="relative">
                            <input type="email" placeholder="Enter your email" class="w-full px-4 py-3 bg-gray-800 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                            <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-primary-500 hover:text-primary-400 transition-colors">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="border-t border-gray-800 py-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm">&copy; 2025 Woolify. All rights reserved.</p>
                    <div class="flex space-x-6 mt-4 md:mt-0">
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors">Privacy Policy</a>
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors">Terms of Service</a>
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors">Cookie Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script>
        AOS.init({ duration: 900, once: true, offset: 80 });
        // Mobile nav toggle
        document.getElementById('nav-toggle').onclick = function() {
            var menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        };
        // FAQ accordion
        function toggleFaq(el) {
            const answer = el.parentElement.querySelector('.faq-a');
            const chevron = el.querySelector('.faq-chevron');
            if (answer.classList.contains('hidden')) {
                answer.classList.remove('hidden');
                answer.classList.add('animate-fade-in');
                chevron.classList.add('rotate-180');
                el.parentElement.classList.add('ring-2', 'ring-primary-200', 'shadow-2xl');
            } else {
                answer.classList.add('hidden');
                answer.classList.remove('animate-fade-in');
                chevron.classList.remove('rotate-180');
                el.parentElement.classList.remove('ring-2', 'ring-primary-200', 'shadow-2xl');
            }
        }
        // Tailwind custom animation
        tailwind.config = {
            theme: {
                extend: {
                    keyframes: {
                        'fade-in': {
                            '0%': { opacity: '0', transform: 'translateY(-10px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        }
                    },
                    animation: {
                        'fade-in': 'fade-in 0.4s ease-out',
                    }
                }
            }
        }
    </script>
    <script>
        // Hide navbar on scroll down, show on scroll up
        (function() {
            var lastScrollTop = 0;
            var navbar = document.querySelector('nav');
            window.addEventListener('scroll', function() {
                var st = window.pageYOffset || document.documentElement.scrollTop;
                if (st > lastScrollTop && st > 80) {
                    // Scroll down
                    navbar.style.transform = 'translateY(-100%)';
                    navbar.style.transition = 'transform 0.3s';
                } else {
                    // Scroll up
                    navbar.style.transform = 'translateY(0)';
                    navbar.style.transition = 'transform 0.3s';
                }
                lastScrollTop = st <= 0 ? 0 : st; // For Mobile or negative scrolling
            }, false);
        })();
    </script>
</body>
</html> 