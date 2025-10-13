<?php
  // Pull contact details from Customizer if available, with sensible defaults
  $phone   = get_theme_mod('mytheme_phone_number', '+45 12 34 56 78');
  $address = 'Pulsen 8, Roskilde 4000, Denmark';
  $email   = 'info@mohamed.com';
?>

<section class="contact" id="contact">
  <div class="container">
    <div class="contact-grid">
      <!-- Left Column - Content -->
      <div class="contact-content">
        <p class="section-subtitle">Contact</p>
        <h2 class="h2 section-title">Have you any project? Drop a message!</h2>
        <p class="section-text">Get in touch and let me know if I can help! Fill out the form and I'll be in touch as soon as possible</p>

        <ul class="contact-list">
          <li class="contact-list-item">
            <div class="contact-item-icon"><ion-icon name="location-outline"></ion-icon></div>
            <div class="wrapper">
              <h3 class="h4 contact-item-title">Address:</h3>
              <address class="contact-info"><?php echo esc_html($address); ?></address>
            </div>
          </li>

          <li class="contact-list-item">
            <div class="contact-item-icon"><ion-icon name="call-outline"></ion-icon></div>
            <div class="wrapper">
              <h3 class="h4 contact-item-title">Phone:</h3>
              <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $phone)); ?>" class="contact-info"><?php echo esc_html($phone); ?></a>
            </div>
          </li>

          <li class="contact-list-item">
            <div class="contact-item-icon"><ion-icon name="mail-outline"></ion-icon></div>
            <div class="wrapper">
              <h3 class="h4 contact-item-title">Email:</h3>
              <a href="mailto:<?php echo esc_attr($email); ?>" class="contact-info"><?php echo esc_html($email); ?></a>
            </div>
          </li>
        </ul>

        <ul class="contact-social-list wrapper">
          <li>
            <a href="<?php echo esc_url($defaults['twitter']); ?>" target="_blank" rel="noopener" class="contact-social-link">
              <i class="fab fa-twitter"></i>
              <div class="tooltip">Twitter</div>
            </a>
          </li>
          <li>
            <a href="<?php echo esc_url($defaults['github']); ?>" target="_blank" rel="noopener" class="contact-social-link">
              <i class="fab fa-github"></i>
              <div class="tooltip">Github</div>
            </a>
          </li>
          <li>
            <a href="<?php echo esc_url($defaults['linkedin']); ?>" target="_blank" rel="noopener" class="contact-social-link">
              <i class="fab fa-linkedin-in"></i>
              <div class="tooltip">LinkedIn</div>
            </a>
          </li>
        </ul>
      </div>

      <!-- Right Column - Form -->
      <form action="" class="contact-form" method="post" novalidate>
      <div class="form-wrapper">
        <label for="name" class="form-label">Name</label>
        <div class="input-wrapper">
          <input type="text" name="name" id="name" required placeholder="John Doe" class="input-field">
          <ion-icon name="person-outline"></ion-icon>
        </div>
      </div>

      <div class="form-wrapper">
        <label for="email" class="form-label">Email</label>
        <div class="input-wrapper">
          <input type="email" name="email" id="email" required placeholder="johndoe@gmail.com" class="input-field">
          <ion-icon name="mail"></ion-icon>
        </div>
      </div>

      <div class="form-wrapper">
        <label for="phone" class="form-label">Phone</label>
        <div class="input-wrapper">
          <input type="tel" name="phone" id="phone" required placeholder="Phone Number" class="input-field">
          <ion-icon name="call"></ion-icon>
        </div>
      </div>

      <div class="form-wrapper">
        <label for="message" class="form-label">Message</label>
        <div class="input-wrapper">
          <textarea name="message" id="message" class="input-field" required placeholder="Write your Message"></textarea>
          <ion-icon name="chatbubbles"></ion-icon>
        </div>
      </div>

      <button type="submit" class="btn btn-primary">Send</button>
    </form>
  </div>
</section>
<style>
   

</style>

<!-- Ionicons for input icons -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
