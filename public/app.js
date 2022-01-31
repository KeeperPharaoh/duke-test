document.addEventListener("DOMContentLoaded", function () {
  let token = localStorage.getItem("token") ? localStorage.getItem("token") : null;
  const baseURL = "https://raptorr.a-lux.dev/api";
  const httpClient = axios.create({
    baseURL: baseURL,
    timeout: 100000,
    headers: { "Authorization": `Bearer ${token}` }, // TODO send token
  });
  const registerSubmitBtn = document.querySelector("#registerSubmitBtn");
  const loginSubmitBtn = document.querySelector("#loginSubmitBtn");
  const uploadSubmitBtn = document.querySelector("#uploadCheckBtn");
  const loginForm = document.querySelector(".login-form");
  const registerForm = document.querySelector(".register-form");

  registerForm.style.display = "none";

  loginSubmitBtn.addEventListener('click', () => {
    const email = document.querySelector("#loginEmail").value;
    const password = document.querySelector("#loginPassword").value;
    console.log('Hello')
    httpClient.post(`${baseURL}/auth/login`, {
      email: email,
      password: password
    }).then((response) => {
      const data = response.data.data
      registerForm.style.display = "none";
      loginForm.style.display = "block";
      localStorage.setItem('token',data.token)
    });
  })
  const doLogin = function () {
    registerForm.style.display = "none";
    loginForm.style.display = "block";
  };
  const doRegistration = function () {
    registerForm.style.display = "block";
    loginForm.style.display = "none";
  };

  let page = 1;
  const getChekcs = function () {
    registerForm.style.display = "none";
    const checkListEl = document.querySelector("#checksPage");
    const pagination = document.querySelector(".pagination");
    checkListEl.innerHTML = "...DOWNLOGDING....";

    httpClient.get(`/checks`, {
      params: {
        page: page
      }
    }).then((resp) => {
      const data = resp.data.data;
      const lastPage = data.last_page;
      console.log(data.last_page)

      for (let page = 1; page <= lastPage; page++) {
        pagination.innerHTML += ` <li class="page-item"><a class="page-link" href="#">${page}</a></li>  `;
      }
      let pageButton = document.querySelectorAll('.page-item');
      pageButton.forEach(p => {
        console.log(p.innerText)
        p.addEventListener("click", () => {
          page = p.innerText
          pagination.innerHTML = ''
          getChekcs()
        })
      })
      const checks = data.data
      checkListEl.innerHTML = "";
      checks.forEach((el) => {
        checkListEl.innerHTML += `<div class="card" style="width: 18rem;">
                  <img class="card-img-top" src="${
                    el.image
                  }" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">${el.name}</h5>
                    <h5 class="card-title">${el.code}</h5>
                    <h5 class="card-title">${el.type}</h5>
                    <h5 class="card-title">${el.status}</h5>
                    <p class="card-text">${new Date(
                      el.created_at
                    ).toLocaleDateString()}
                    </p>

                  </div>
                </div>`;
      });
    });
  };

  const saveCheck = function(){
        const checkListEl = document.querySelector("#checksPage").style.display = "none";
           registerForm.style.display = "none";
    loginForm.style.display = "none";

  }



  registerSubmitBtn.addEventListener("click", (e) => {
    e.preventDefault();
    const email = document.querySelector("#registerEmail").value;
    const name = document.querySelector("#registerName").value;
    const password = document.querySelector("#registerPassword").value;
    const params = { email, name, password };

    httpClient.post(`${baseURL}/auth/register`, params).then((response) => {
      const data = response.data.data
      // TODO save token to LS
      location.hash = "checks";
      localStorage.setItem('token',data.token)

    });
  });

  const pagination = document.querySelector(".pagination");

  console.log(pagination.value)


  // TODO do delat
  uploadSubmitBtn.addEventListener("click", (e) => {
    e.preventDefault();
    if(localStorage.getItem('token')){
      const file = document.querySelector("#checkFile");
      const formData = new FormData()
      formData.append("image", file.files[0])
      httpClient.post(`${baseURL}/check/unload`, formData).then((data) => {
        console.log(data);
        location.hash = "checks";
      });
    }else {
      alert("Зарегистрируйтесь пожалуйтса")
    }
  });



  loginSubmitBtn.addEventListener("click", (e) => {
    e.preventDefault();
    registerForm.style.display = "none";
    loginForm.style.display = "none";
  });

  const hash = location.hash;

  router(hash);

  window.onhashchange = (e) => {
    const hash = location.hash;
    router(hash);
  };

  function router(hash) {
    switch (hash) {
      case "":
        getChekcs();
        return;
      case "#login":
        doLogin();
        return;
      case "#registration":
        doRegistration();
        return;
      case "#checks":
        getChekcs();
        return;
      case "#saveCheck":
        saveCheck();
        return;
    }
  }
});
