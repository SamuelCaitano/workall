const chk = document.getElementById('chk');
let dark = document.getElementById("dark");

chk.addEventListener('change', (e) => {
  // change the theme of the website
  dark.classList.toggle("dark", e.target.checked);
}); 
