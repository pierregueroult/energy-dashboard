function utils() {
  // handle dark mode
  const darkModeButton = document.getElementById("dark-mode-button");
  darkModeButton.addEventListener("click", () => {
    document.body.classList.toggle("dark");
    darkModeButton.classList.toggle("light-button");
  });

  // handle hamburger menu
  const menuButton = document.getElementById("menu-button");
  const menu = document.getElementById("menu");
  menuButton.addEventListener("click", () => {
    // if menu has class "w-0", replace it with w-72 and vice versa
    if (menu.classList.contains("w-0")) {
      menu.classList.replace("w-0", "w-72");
    } else {
      menu.classList.replace("w-72", "w-0");
    }
  });

  if (window.location.href.includes("boosted")) {
    const regionButton = document.getElementById("region-button");
    regionButton.addEventListener("click", toggleDepartementDropdown);
  }

  const yearButton = document.getElementById("year-button");
  yearButton.addEventListener("click", toggleYearDropdown);
}

function storeDepartement(departement) {
  localStorage.setItem("departement", departement);
  document.getElementById("region-button-text").innerText = departement;
  toggleDepartementDropdown();
  loadCharts(departement);
}

function toggleDepartementDropdown() {
  const regionMenu = document.getElementById("region-dropdown");
  const regionButtonSvg = document.getElementById("region-button-svg");

  regionButtonSvg.classList.toggle("rotate-180");
  regionMenu.classList.toggle("pointer-events-none");
  regionMenu.classList.toggle("opacity-0");
}

function toggleYearDropdown() {
  const yearMenu = document.getElementById("year-dropdown");
  const yearButtonSvg = document.getElementById("year-button-svg");

  yearButtonSvg.classList.toggle("rotate-180");
  yearMenu.classList.toggle("pointer-events-none");
  yearMenu.classList.toggle("opacity-0");
}

function storeYear(year) {
  localStorage.setItem("year", year);
  document.getElementById("year-button-text").innerText = year;
  toggleYearDropdown();
  loadYearlyCharts(getStoredDepartment(), year);
}

function toggleDialog() {
  const dialog = document.getElementById("dialog");
  dialog.classList.toggle("opacity-0");
  dialog.classList.toggle("pointer-events-none");
}

document.addEventListener("DOMContentLoaded", utils);
