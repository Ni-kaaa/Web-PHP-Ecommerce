<main class="main">
  <h2>Contact Us</h2>

  <section class="contact-form">
    <form action="#" method="POST">
      <div class="form-group">
        <label for="name">Your Name</label>
        <input type="text" id="name" name="name" required placeholder="Enter your name" />
      </div>

      <div class="form-group">
        <label for="email">Your Email</label>
        <input type="email" id="email" name="email" required placeholder="Enter your email" />
      </div>

      <div class="form-group">
        <label for="subject">Subject</label>
        <input type="text" id="subject" name="subject" required placeholder="Enter subject" />
      </div>

      <div class="form-group">
        <label for="message">Message</label>
        <textarea id="message" name="message" required placeholder="Your message" rows="6"></textarea>
      </div>

      <div class="form-group">
        <button type="submit">Send Message</button>
      </div>
    </form>
  </section>
</main>

<style>
  .main {
    padding: 20px;
  }

  h2 {
    margin-left: 20%;
  }

  .contact-form {
    width: 60%;
    margin: 0 auto;
    padding: 20px;
    background-color: #f4f4f4;
    border-radius: 8px;
  }

  .form-group {
    margin-bottom: 20px;
  }

  .form-group label {
    display: block;
    margin-bottom: 8px;
    font-size: 16px;
  }

  .form-group input,
  .form-group textarea {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  .form-group textarea {
    resize: vertical;
  }

  .form-group button {
    padding: 12px 20px;
    font-size: 16px;
    background-color: #3399FF;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  .form-group button:hover {
    background-color: rgb(63, 142, 221);
  }
</style>