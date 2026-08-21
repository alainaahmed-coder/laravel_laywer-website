/* LegalEase — dashboard pane switching (Vanilla JS) */

document.addEventListener("DOMContentLoaded", function () {
  const links = document.querySelectorAll("[data-nav]");
  const panes = document.querySelectorAll("[data-pane]");

  function show(name) {
    panes.forEach((p) => p.classList.toggle("d-none", p.dataset.pane !== name));
    document.querySelectorAll(".side-link").forEach((l) =>
      l.classList.toggle("active", l.dataset.nav === name)
    );
    window.scrollTo({ top: 0, behavior: "smooth" });
    history.replaceState(null, "", "#" + name);
  }

  links.forEach((l) => {
    l.addEventListener("click", function (e) {
      e.preventDefault();
      show(this.dataset.nav);
    });
  });

  const hash = location.hash.replace("#", "");
  if (hash && document.querySelector('[data-pane="' + hash + '"]')) show(hash);
});
