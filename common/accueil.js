/* Fonction qui regarde le local storage l'attribut "lang" et selon l'attribut active/désactive les textes français/anglais */
function changeLang() {
    /* Si y'a rien dans le local storage il met l'attribut FR si il y a quelque chose il prend la valeur du local storage */
    var lang = !localStorage.getItem("lang")
      ? "fr"
      : localStorage.getItem("lang");
    if (lang === "fr") {
      for (let i = 0; i < francais.length; i++) {
        francais[i].style.display = "block";
        anglais[i].style.display = "none";
      }
    } else if (lang === "en") {
      for (let i = 0; i < anglais.length; i++) {
        anglais[i].style.display = "block";
        francais[i].style.display = "none";
      }
    }
  }
  
  let anglais = document.getElementsByClassName("en");
  let francais = document.getElementsByClassName("fr");
  
  /* Fonction au chargement de la page */
  window.onload = function () {
    /* Appel de la fonction changeLang */
    changeLang();
  
    const btnFr = document.querySelector(".btnFr");
    const btnEn = document.querySelector(".btnEn");
  
    /* Ecoute du clic du "bouton" FR */
    btnFr.addEventListener("click", function change(e) {
      /* On enlève sa fonction par défaut */
      e.preventDefault();
      /* Comme précédemment si aucun attribut alors attribut = FR sinon il prend l'attribut du local storage */
      var lang = !localStorage.getItem("lang")
        ? "fr"
        : localStorage.getItem("lang");
      /* Si le local storage est en anglais il remplace sa valeur par FR et appel la fonction changeLang */
      if (lang == "en") {
        localStorage.setItem("lang", "fr");
        changeLang();
      }
    });
    btnEn.addEventListener("click", function change(e) {
      /* On enlève sa fonction par défaut */
      e.preventDefault();
      /* Comme précédemment si aucun attribut alors attribut = FR sinon il prend l'attribut du local storage */
      var lang = !localStorage.getItem("lang")
        ? "fr"
        : localStorage.getItem("lang");
      /* Si le local storage est en français il remplace sa valeur par EN et appel la fonction changeLang */
      if (lang == "fr") {
        localStorage.setItem("lang", "en");
        changeLang();
      }
    });
  };