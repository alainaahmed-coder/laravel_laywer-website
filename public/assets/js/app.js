/* LegalEase — shared UI logic (Vanilla JS only) */

const money = (n) => "PKR " + n.toLocaleString("en-US");

function stars(rating) {
  let out = "";
  for (let i = 1; i <= 5; i++) {
    if (rating >= i) out += '<i class="bi bi-star-fill"></i>';
    else if (rating >= i - 0.5) out += '<i class="bi bi-star-half"></i>';
    else out += '<i class="bi bi-star"></i>';
  }
  return out;
}

function statusBadge(status) {
  const map = {
    Approved: "text-bg-success",
    Pending: "text-bg-warning",
    Completed: "text-bg-primary",
    Cancelled: "text-bg-danger",
    Rejected: "text-bg-danger"
  };
  return `<span class="badge rounded-pill ${map[status] || "text-bg-secondary"}">${status}</span>`;
}

function lawyerCard(l) {
  return `
  <div class="col-12 col-sm-6 col-lg-4">
    <article class="card-legal h-100 p-4 d-flex flex-column">
      <div class="d-flex align-items-center gap-3">
        <img src="${l.img}" alt="Portrait of ${l.name}" class="avatar" loading="lazy">
        <div>
          <h3 class="h6 mb-1">${l.name} ${l.verified ? '<i class="bi bi-patch-check-fill text-gold" title="Verified lawyer"></i>' : ""}</h3>
          <div class="rating">${stars(l.rating)} <span class="text-muted-legal ms-1 small">${l.rating.toFixed(1)} (${l.reviews})</span></div>
        </div>
      </div>
      <div class="mt-3 d-flex flex-wrap gap-2">
        <span class="badge-spec small">${l.spec}</span>
        <span class="badge-gold small"><i class="bi bi-geo-alt me-1"></i>${l.city}</span>
      </div>
      <div class="row g-2 mt-3 small text-muted-legal">
        <div class="col-6"><i class="bi bi-briefcase me-1"></i>${l.exp} yrs experience</div>
        <div class="col-6"><i class="bi bi-cash-coin me-1"></i>${money(l.fee)}</div>
      </div>
      <a href="lawyer-profile.html?id=${l.id}" class="btn btn-navy w-100 mt-4 mt-auto">
        View Full Profile &amp; Book
      </a>
    </article>
  </div>`;
}

function fillSelect(el, items, placeholder) {
  if (!el) return;
  el.innerHTML =
    `<option value="">${placeholder}</option>` +
    items.map((i) => `<option value="${i}">${i}</option>`).join("");
}

/* Scroll reveal micro-interaction */
function initReveal() {
  const items = document.querySelectorAll(".fade-up");
  if (!("IntersectionObserver" in window)) {
    items.forEach((i) => i.classList.add("in"));
    return;
  }
  const io = new IntersectionObserver(
    (entries) => {
      entries.forEach((e) => {
        if (e.isIntersecting) {
          e.target.classList.add("in");
          io.unobserve(e.target);
        }
      });
    },
    { threshold: 0.12 }
  );
  items.forEach((i) => io.observe(i));
}

/* Bootstrap-style form validation */
function initValidation() {
  document.querySelectorAll("form.needs-validation").forEach((form) => {
    form.addEventListener("submit", (ev) => {
      const pw = form.querySelector('[data-role="password"]');
      const cpw = form.querySelector('[data-role="confirm"]');
      if (pw && cpw) {
        cpw.setCustomValidity(pw.value === cpw.value ? "" : "mismatch");
      }
      if (!form.checkValidity()) {
        ev.preventDefault();
        ev.stopPropagation();
      } else {
        ev.preventDefault();
        const alertBox = form.querySelector('[data-role="form-alert"]');
        if (alertBox) {
          alertBox.classList.remove("d-none");
          alertBox.scrollIntoView({ behavior: "smooth", block: "center" });
        }
      }
      form.classList.add("was-validated");
    });
  });
}

/* Highlight active nav link */
function initActiveNav() {
  const page = location.pathname.split("/").pop() || "index.html";
  document.querySelectorAll(".navbar-legal .nav-link").forEach((a) => {
    if (a.getAttribute("href") === page) a.classList.add("active");
  });
}

document.addEventListener("DOMContentLoaded", () => {
  initReveal();
  initValidation();
  initActiveNav();
  const y = document.getElementById("year");
  if (y) y.textContent = new Date().getFullYear();
});
