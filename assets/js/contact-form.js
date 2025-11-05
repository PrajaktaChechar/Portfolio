document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("contact-form");
  if (!form) return;

  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const loading = form.querySelector(".loading");
    const errorMessage = form.querySelector(".error-message");
    const sentMessage = form.querySelector(".sent-message");

    // Reset message visibility
    loading.style.display = "block";
    errorMessage.style.display = "none";
    sentMessage.style.display = "none";

    try {
      const response = await fetch(form.action, {
        method: "POST",
        body: new FormData(form),
        headers: { "Accept": "application/json" }
      });

      loading.style.display = "none";

      if (response.ok) {
        sentMessage.style.display = "block";
        form.reset();
      } else {
        const data = await response.json();
        errorMessage.textContent = data.error || "Error sending message.";
        errorMessage.style.display = "block";
      }
    } catch (error) {
      loading.style.display = "none";
      errorMessage.textContent = "Network error. Please try again.";
      errorMessage.style.display = "block";
    }
  });
});
