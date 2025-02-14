<!-- Add this inside your whatsapp.blade.php -->
<!-- WhatsApp Button Container -->
<div class="whatsapp-container">
    <div class="popup-message" id="whatsappPopup">
        <div class="message-carousel">
            <div class="message-text active">👋 Hey there! Need assistance?</div>
            <div class="message-text">💬 Chat with us on WhatsApp</div>
            <div class="message-text">🌟 Get instant help with Ciala Residence!</div>
        </div>
    </div>
    <a href="https://wa.me/254798984929?text=Hello! I'm reaching out from the motorspeedcourier website. I'd like to learn more about your Services."
        target="_blank" class="whatsapp-button">
        <i class="fab fa-whatsapp"></i>
    </a>
</div>

<!-- Add this in your <head> section -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    .whatsapp-container {
        position: fixed;
        bottom: 20px;
        left: 20px;
        z-index: 1000;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
    }

    .whatsapp-button {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 65px;
        height: 65px;
        background: linear-gradient(145deg, #28E16F, #20BD5B);
        border-radius: 50%;
        box-shadow: 0 4px 15px rgba(37, 211, 102, 0.3);
        transition: all 0.3s ease;
        animation: pulse 2s infinite;
    }

    .whatsapp-button:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(37, 211, 102, 0.4);
    }

    .whatsapp-button i {
        font-size: 34px;
        color: white;
    }

    .popup-message {
        background: white;
        padding: 12px 25px;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        font-size: 15px;
        color: #333;
        position: relative;
        min-width: 220px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        margin-bottom: 5px;
    }

    .popup-message::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        border-width: 10px 10px 0 10px;
        border-style: solid;
        border-color: white transparent transparent transparent;
    }

    .message-carousel {
        position: relative;
        height: 24px;
        overflow: hidden;
        text-align: center;
    }

    .message-text {
        position: absolute;
        width: 100%;
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.5s ease;
    }

    .message-text.active {
        opacity: 1;
        transform: translateY(0);
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.6);
        }

        70% {
            box-shadow: 0 0 0 15px rgba(37, 211, 102, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
        }
    }

    /* Modern glass morphism effect on hover */
    .popup-message:hover {
        background: rgba(255, 255, 255, 0.95);
        transform: translateY(-3px);
        box-shadow: 0 6px 25px rgba(0, 0, 0, 0.12);
        transition: all 0.3s ease;
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .whatsapp-container {
            left: 10px;
        }

        .popup-message {
            min-width: 200px;
            padding: 10px 20px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const messages = document.querySelectorAll('.message-text');
        let currentIndex = 0;

        function rotateMessages() {
            messages.forEach(msg => msg.classList.remove('active'));
            messages[currentIndex].classList.add('active');

            currentIndex = (currentIndex + 1) % messages.length;
        }

        // Initial state
        rotateMessages();

        // Rotate messages every 3 seconds
        setInterval(rotateMessages, 3000);

        // Add hover animation for the button
        const whatsappButton = document.querySelector('.whatsapp-button');
        whatsappButton.addEventListener('mouseover', function() {
            this.style.transform = 'translateY(-5px) scale(1.05)';
        });

        whatsappButton.addEventListener('mouseout', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
</script>
