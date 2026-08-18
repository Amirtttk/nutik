let domain = window.location.origin + "/";
function empty($date) {
  return $date === "" || $date === "0" || $date === 0 || $date == [];
}
function isEmpty($data, $str = "-------") {
  return empty($data) ? $str : $data;
}
function copyToClipbord(id) {
  var copyText = document.getElementById('myInput'+id);
  copyText.select();
  copyText.setSelectionRange(0, 99999);
  navigator.clipboard.writeText(parseInt(copyText.value));
}
function scroll(len, speed) {
  $("body,html").animate({ scrollTop: len }, speed);
}
function createSlug(title) {
  return title.replace(/([^0-9آ-یa-z0-9])+/g, "-");
}
function loading(response) {
  userNameAlert.innerHTML = `${response.name} عزیز لطفا کمی صبر کنید . `;
  setTimeout(() => {
    userNameAlert.innerHTML = `${response.name} عزیز لطفا کمی صبر کنید .. `;
    setTimeout(() => {
      userNameAlert.innerHTML = `${response.name} عزیز لطفا کمی صبر کنید ... `;
    }, 350);
  }, 350);
}
function changeFormForgotPassword(changeForgotPassword, changePasswordNow) {
  let opacity = 1;
  const interval = setInterval(() => {
    opacity -= 0.1;
    changeForgotPassword.style.opacity = opacity;
    if (opacity <= 0) {
      changeForgotPassword.style.display = "none";
      changePasswordNow.style.opacity = 1;
      changePasswordNow.style.display = "block";
      clearInterval(interval);
    }
  }, 30);
}
function login(type_user) {
  let userName = $('input[name="userName"]').val(),
    password = $('input[name="password"]').val(),
    userNameAlert = document.getElementById("userNameAlert");

  $.ajax({
    url: `${domain}requests/admin/login.php`,
    type: "POST",
    data: {
      userName,
      password,
      type_user,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        userNameAlert.innerHTML = "";
        userNameAlert.classList.replace("text-danger", "text-success");

        loading(response);
        setInterval(() => loading(response), 1050);
        setTimeout(() => location.replace("dashboard"), 3150);
      } else {
        userNameAlert.classList.replace("text-success", "text-danger");
        if (response.status == 300)
          userNameAlert.innerHTML =
            "پست الکترونیک و کلمه عبور را به درستی وارد کنید";
        else userNameAlert.innerHTML = "مشخصاتی که وارد کرده اید درست نمیباشد";
      }
    },
  });
}
function logout() {
  Swal.fire({
    title: `آیا با خروج از پنل مدیریت موافقید ؟`,
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "بله",
    cancelButtonText: "خیر",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: `${domain}requests/logout.php`,
        type: "POST",
        data: {},
        success: function (response) {
          response = JSON.parse(response);
          if (response.status == 200) {
            location.replace(domain);
          } else {
            location.reload();
          }
        },
      });
    }
  });
}
function updateInformation(id) {
  let title_store = $('input[name="title_store"]').val(),
      mobileHeather = $('input[name="mobileHeather"]').val(),
      text = $('textarea[name="text"]').val(),
      getErrors = document.getElementById("getErrors");
  $.ajax({
    url: `${domain}requests/information/update.php`,
    type: "POST",
    data: {
      title_store,
      mobileHeather,
      text,
      id,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        getErrors.innerHTML = "";
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      } else {
        getErrors.innerHTML = response.error;
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        scroll(150, 1000);
      }
    },
  });
}
function update(id) {
  let title_store = $('input[name="title_store"]').val(),
      mobileHeather = $('input[name="mobileHeather"]').val(),
      text = $('input[name="text"]').val(),
      getErrors = document.getElementById("getErrors");
  $.ajax({
    url: `${domain}requests/information/update.php`,
    type: "POST",
    data: {
      title_store,
      mobileHeather,
      text,
      id,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        getErrors.innerHTML = "";
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      } else {
        getErrors.innerHTML = response.error;
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        scroll(150, 1000);
      }
    },
  });
}
function updateTheme(id) {
  let color = $('input[name="color"]').val(),
      color2 = $('input[name="color2"]').val(),
      color3 = $('input[name="color3"]').val(),
      theme = $('select[name="theme"]').val(),
      font = $('select[name="font"]').val(),
      getErrors = document.getElementById("getErrors");
  $.ajax({
    url: `${domain}requests/information/updateTheme.php`,
    type: "POST",
    data: {
      color,
      color2,
      color3,
      theme,
      font,
      id,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        getErrors.innerHTML = "";
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      } else {
        getErrors.innerHTML = response.error;
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        scroll(150, 1000);
      }
    },
  });
}
function updateInfoUser() {
  let userFullName = $('input[name="userFullName"]').val(),
      userName = $('input[name="userName"]').val(),
      dateBirth = $('input[name="dateBirth"]').val(),
      gender = $('select[name="gender"]').val(),
      btnUpdateInfo = document.getElementById("btnUpdateInfo");

  btnUpdateInfo.disabled = true;
  $.ajax({
    url: `${domain}requests/admin/updateInformation.php`,
    type: "POST",
    data: {
      userFullName,
      userName,
      dateBirth,
      gender,
    },
    success: function (response) {
      response = JSON.parse(response);
      setTimeout(() => {
        btnUpdateInfo.disabled = false;
      }, 3000);
      if (response.status == 200) {
        document.getElementById("divShowError").classList.add("d-none");
        document.getElementById("showError").innerHTML = "";
        document.getElementById("showFullName").innerHTML = userFullName;
        document.getElementById("showFullNameProfile").innerHTML = userFullName;
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      } else {
        document.getElementById("divShowError").classList.remove("d-none");
        document.getElementById("showError").innerHTML = response.text;
        scroll(150, 1000);
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      }
    },
  });
}
function resetPassword() {
  let password = $('input[name="password"]').val(),
      newPassword = $('input[name="newPassword"]').val(),
      repeatNewPassword = $('input[name="repeatNewPassword"]').val(),
      btnResetPassword = document.getElementById("btnResetPassword");

  btnResetPassword.disabled = true;

  $.ajax({
    url: `${domain}requests/admin/resetPassword.php`,
    type: "POST",
    data: {
      password,
      newPassword,
      repeatNewPassword,
    },
    success: function (response) {
      setTimeout(() => {
        btnResetPassword.disabled = false;
      }, 3000);
      response = JSON.parse(response);
      if (response.status == 200) {
        document.getElementById("changePasswordNow").reset();
        document.getElementById("divShowError2").classList.add("d-none");
        document.getElementById("showError2").innerHTML = "";
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      } else {
        document.getElementById("divShowError2").classList.remove("d-none");
        document.getElementById("showError2").innerHTML = response.text;
        scroll(550, 1000);
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      }
    },
  });
}
function resetPasswordWithMobile() {
  let mobile = $('input[name="mobile"]').val(),
      btnResetPasswordWithMobile = document.getElementById(
          "btnResetPasswordWithMobile"
      ),
      showError = document.getElementById("showError3");

  btnResetPasswordWithMobile.disabled = true;

  $.ajax({
    url: `${domain}requests/admin/resetPasswordWithMobile.php`,
    type: "POST",
    data: {
      mobile,
    },
    success: function (response) {
      setTimeout(() => {
        btnResetPasswordWithMobile.disabled = false;
      }, 3000);
      response = JSON.parse(response);
      if (response.status == 200) {
        document.getElementById("divShowError3").classList.add("d-none");
        document.getElementById("showError3").innerHTML = "";
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        setTimeout(() => {
          changeFormForgotPassword(
              document.getElementById("changeForgotPassword"),
              document.getElementById("changeMobile")
          );
          document.getElementById("showCode").innerHTML = response.code;
        }, 1500);
      } else {
        document.getElementById("divShowError3").classList.remove("d-none");
        document.getElementById("showError3").innerHTML = response.text;
        scroll(550, 1000);
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      }
    },
  });
}
function confirmCode() {
  let code = $('input[name="code"]').val(),
      btnResetPasswordCheckCode = document.getElementById(
          "btnResetPasswordCheckCode"
      ),
      showError = document.getElementById("showError4");

  btnResetPasswordCheckCode.disabled = true;

  $.ajax({
    url: `${domain}requests/admin/checkedCode.php`,
    type: "POST",
    data: {
      code,
    },
    success: function (response) {
      setTimeout(() => {
        btnResetPasswordCheckCode.disabled = false;
      }, 3000);
      response = JSON.parse(response);
      if (response.status == 200) {
        document.getElementById("divShowError4").classList.add("d-none");
        document.getElementById("showError4").innerHTML = "";
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        setTimeout(() => {
          changeFormForgotPassword(
              document.getElementById("changeMobile"),
              document.getElementById("submitNewPassword")
          );
        }, 1500);
      } else {
        document.getElementById("divShowError4").classList.remove("d-none");
        document.getElementById("showError4").innerHTML = response.text;
        scroll(550, 1000);
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      }
    },
  });
}
function submitPassword() {
  let newPasswordSubmit = $('input[name="newPasswordSubmit"]').val(),
      repeatNewPasswordSubmit = $('input[name="repeatNewPasswordSubmit"]').val(),
      btnSubmitPassword = document.getElementById("btnSubmitPassword"),
      showError = document.getElementById("showError5");

  btnSubmitPassword.disabled = true;

  $.ajax({
    url: `${domain}requests/admin/submitPassword.php`,
    type: "POST",
    data: {
      newPasswordSubmit,
      repeatNewPasswordSubmit,
    },
    success: function (response) {
      setTimeout(() => {
        btnSubmitPassword.disabled = false;
      }, 3000);
      response = JSON.parse(response);
      if (response.status == 200) {
        document.getElementById("divShowError5").classList.add("d-none");
        document.getElementById("showError5").innerHTML = "";
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        setTimeout(() => {
          changeFormForgotPassword(
              document.getElementById("submitNewPassword"),
              document.getElementById("changePasswordNow")
          );
          document.getElementById("changePasswordNow").reset();
          document.getElementById("changeMobile").reset();
          document.getElementById("submitNewPassword").reset();
        }, 1500);
      } else {
        document.getElementById("divShowError5").classList.remove("d-none");
        document.getElementById("showError5").innerHTML = response.text;
        scroll(550, 1000);
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      }
    },
  });
}
function updateImageLogo(id) {
  let getErrors = document.getElementById('errors6');
  let formData = new FormData();
  formData.append("image", $("#inputFile")[0].files[0]);
  formData.append("id", id);
  document.getElementById('uploadedFileName').innerHTML = $("#inputFile")[0].files[0].name;
  $.ajax({
    type: "POST",
    enctype: 'multipart/form-data',
    url:`${domain}requests/information/photo.php`,
    data: formData,
    processData: false,
    contentType: false,
    cache: false,
    timeout: 600000,
    success: function (response) {
      Swal.fire({
        title: 'در حال ویرایش تصویر لوگو',
        html: 'لطفا منتظر بمانید',
        timer: 2000,
        timerProgressBar: true,
        didOpen: () => {
          Swal.showLoading()
          const b = Swal.getHtmlContainer().querySelector('b')
          timerInterval = setInterval(() => {
            b.textContent = Swal.getTimerLeft()
          }, 2000)
        },
        willClose: () => {
          clearInterval(timerInterval)
        }
      }).then((result) => {
        if (result.dismiss === Swal.DismissReason.timer) { }
      })
          .then(function () {
            response = JSON.parse(response);
            if (response.status == 200) {
              Toast.fire({
                icon: response.type,
                title: response.text,
              });
              document.getElementById("myformImageBrand").reset();
              let buttonImage = document.querySelector('#buttonImage');
              let buttonImage2 = document.querySelector('#buttonImage2');
              document.getElementById('imageOld').src = response.src;
              // setTimeout(() => location.replace('managementSupport.php'), 3000)
            } else {
              Toast.fire({
                icon: response.type,
                title: response.text,
              });
            }
          })
    }
  });
}
function createBlogCategory() {
  let title = $('input[name="title"]').val(),
      image = $('input[name="image"]')[0].files[0],
      getErrors = document.getElementById("getErrors");
  let formData = new FormData();
  formData.append("title", title);
  if (image) {
    formData.append("image", image);
  }
  $.ajax({
    url: `${domain}requests/blogCategory/create.php`,
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      response = JSON.parse(response);
      if (response.status === 200) {
        getErrors.innerHTML = "";
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        setTimeout(() => location.replace("management"), 3000);
      } else {
        getErrors.innerHTML = response.error;
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        scroll(150, 1000);
      }
    },
  });
}
function createFaq() {
  let title = $('input[name="title"]').val(),
      description = $('input[name="description"]').val(),
      type = $('select[name="type"]').val(),
      getErrors = document.getElementById("getErrors");
  $.ajax({
    url: `${domain}requests/faq/create.php`,
    type: "POST",
    data: {
      title,
      description,
      type,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        getErrors.innerHTML = "";
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        setTimeout(() => location.replace("management"), 3000);
      } else {
        getErrors.innerHTML = response.error;
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        scroll(150, 1000);
      }
    },
  });
}
function statusFaq(id, status) {
  $.ajax({
    url: `${domain}requests/faq/status.php`,
    type: "POST",
    data: {
      id,
      status,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        if (status === 1) {
          document.getElementById("statusShow" + id).innerHTML = `
                        <span class="label label-lg font-weight-bold label-light-success label-inline">فعال</span>
                    `;
          document
              .getElementById("changeStatusInput" + id)
              .setAttribute(
                  "onclick",
                  `statusFaq(${id}, 2)`
              );
        } else {
          document.getElementById("statusShow" + id).innerHTML = `
                        <span class="label label-lg font-weight-bold label-light-warning label-inline">غیر فعال</span>
                    `;
          document
              .getElementById("changeStatusInput" + id)
              .setAttribute(
                  "onclick",
                  `statusFaq(${id}, 1)`
              );
        }
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      } else {
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      }
    },
  });
}
function updateFaq(id) {
  let title = $('input[name="title"]').val(),
      description = $('input[name="description"]').val(),
      type = $('select[name="type"]').val(),
      getErrors = document.getElementById("getErrors");

  $.ajax({
    url: `${domain}requests/faq/update.php`,
    type: "POST",
    data: {
      title,
      description,
      type,
      id
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        getErrors.innerHTML = "";
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      } else {
        getErrors.innerHTML = response.error;
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        scroll(150, 1000);
      }
    },
  });
}
function delteFaq(Id) {

  $.ajax({
    url: `${domain}requests/faq/delete.php`,
    type: "POST",
    data: {
      Id,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        document.getElementById('deleteFaq'+Id).style.display="none";
      } else {
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      }
    },
  });
}
function updateAboutUs(id) {
  let description = $('textarea[name="description"]').val(),
      getErrors = document.getElementById("getErrors");

  $.ajax({
    url: `${domain}requests/aboutUs/update.php`,
    type: "POST",
    data: {
      description,
      id
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        getErrors.innerHTML = "";
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      } else {
        getErrors.innerHTML = response.error;
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        scroll(150, 1000);
      }
    },
  });
}
function updateImageAboutUs(id) {
  let formData = new FormData();
  formData.append("image", $("#inputFile")[0].files[0]);
  formData.append("id", id);
  document.getElementById('uploadedFileName').innerHTML = $("#inputFile")[0].files[0].name;
  $.ajax({
    type: "POST",
    enctype: 'multipart/form-data',
    url:`${domain}requests/aboutUs/photo.php`,
    data: formData,
    processData: false,
    contentType: false,
    cache: false,
    timeout: 600000,
    success: function (response) {
      Swal.fire({
        title: 'در حال ویرایش تصویر صفحه اصلی',
        html: 'لطفا منتظر بمانید',
        timer: 2000,
        timerProgressBar: true,
        didOpen: () => {
          Swal.showLoading()
          const b = Swal.getHtmlContainer().querySelector('b')
          timerInterval = setInterval(() => {
            b.textContent = Swal.getTimerLeft()
          }, 2000)
        },
        willClose: () => {
          clearInterval(timerInterval)
        }
      }).then((result) => {
        if (result.dismiss === Swal.DismissReason.timer) { }
      })
          .then(function () {
            response = JSON.parse(response);
            if (response.status == 200) {
              Toast.fire({
                icon: response.type,
                title: response.text,
              });
              document.getElementById("myformImageBrand").reset();
              let buttonImage = document.querySelector('#buttonImage');
              let buttonImage2 = document.querySelector('#buttonImage2');
              document.getElementById('imageOld').src = response.src;
              // setTimeout(() => location.replace('managementSupport.php'), 3000)
            } else {
              Toast.fire({
                icon: response.type,
                title: response.text,
              });
            }
          })
    }
  });
}
function createBrand() {
  let title = $('input[name="title"]').val(),
      image = $('input[name="image"]')[0].files[0],
      getErrors = document.getElementById("getErrors");
  let formData = new FormData();
  formData.append("title", title);
  if (image) {
    formData.append("image", image);
  }
  $.ajax({
    url: `${domain}requests/brand/create.php`,
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      response = JSON.parse(response);
      if (response.status === 200) {
        getErrors.innerHTML = "";
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        setTimeout(() => location.replace("management"), 3000);
      } else {
        getErrors.innerHTML = response.error;
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        scroll(150, 1000);
      }
    },
  });
}
function statusBrand(id, status) {
  $.ajax({
    url: `${domain}requests/brand/status.php`,
    type: "POST",
    data: {
      id,
      status,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        if (status === 1) {
          document.getElementById("statusShow" + id).innerHTML = `
                        <span class="label label-lg font-weight-bold label-light-success label-inline">فعال</span>
                    `;
          document
              .getElementById("changeStatusInput" + id)
              .setAttribute(
                  "onclick",
                  `statusBrand(${id}, 2)`
              );
        } else {
          document.getElementById("statusShow" + id).innerHTML = `
                        <span class="label label-lg font-weight-bold label-light-warning label-inline">غیر فعال</span>
                    `;
          document
              .getElementById("changeStatusInput" + id)
              .setAttribute(
                  "onclick",
                  `statusBrand(${id}, 1)`
              );
        }
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      } else {
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      }
    },
  });
}
function updateBrand(id) {
  let title = $('input[name="title"]').val(),
      getErrors = document.getElementById("getErrors");

  $.ajax({
    url: `${domain}requests/brand/update.php`,
    type: "POST",
    data: {
      title,
      id,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        getErrors.innerHTML = "";
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      } else {
        getErrors.innerHTML = response.error;
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        scroll(150, 1000);
      }
    },
  });
}
function updateImageBrand(id) {
  let getErrors = document.getElementById('errors6');
  let formData = new FormData();
  formData.append("image", $("#inputFile")[0].files[0]);
  formData.append("id", id);
  document.getElementById('uploadedFileName').innerHTML = $("#inputFile")[0].files[0].name;
  $.ajax({
    type: "POST",
    enctype: 'multipart/form-data',
    url:`${domain}requests/brand/photo.php`,
    data: formData,
    processData: false,
    contentType: false,
    cache: false,
    timeout: 600000,
    success: function (response) {
      Swal.fire({
        title: 'در حال ویرایش تصویر برند',
        html: 'لطفا منتظر بمانید',
        timer: 2000,
        timerProgressBar: true,
        didOpen: () => {
          Swal.showLoading()
          const b = Swal.getHtmlContainer().querySelector('b')
          timerInterval = setInterval(() => {
            b.textContent = Swal.getTimerLeft()
          }, 2000)
        },
        willClose: () => {
          clearInterval(timerInterval)
        }
      }).then((result) => {
        if (result.dismiss === Swal.DismissReason.timer) { }
      })
          .then(function () {
            response = JSON.parse(response);
            if (response.status == 200) {
              Toast.fire({
                icon: response.type,
                title: response.text,
              });
              document.getElementById("myformImageBrand").reset();
              let buttonImage = document.querySelector('#buttonImage');
              let buttonImage2 = document.querySelector('#buttonImage2');
              document.getElementById('imageOld').src = response.src;
              // setTimeout(() => location.replace('managementSupport.php'), 3000)
            } else {
              Toast.fire({
                icon: response.type,
                title: response.text,
              });
            }
          })
    }
  });
}
function statusBlog(id, status) {
  $.ajax({
    url: `${domain}requests/blog/status.php`,
    type: "POST",
    data: {
      id,
      status,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        if (status === 1) {
          document.getElementById("statusShow" + id).innerHTML = `
                        <span class="label label-lg font-weight-bold label-light-success label-inline">فعال</span>
                    `;
          document
              .getElementById("changeStatusInput" + id)
              .setAttribute(
                  "onclick",
                  `statusBlog(${id}, 2)`
              );
        } else {
          document.getElementById("statusShow" + id).innerHTML = `
                        <span class="label label-lg font-weight-bold label-light-warning label-inline">غیر فعال</span>
                    `;
          document
              .getElementById("changeStatusInput" + id)
              .setAttribute(
                  "onclick",
                  `statusBlog(${id}, 1)`
              );
        }
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      } else {
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      }
    },
  });
}
function updateBlog(id) {

  const form = document.getElementById('productForm');
  const formData = new FormData();

  // تمام فیلدهای فرم
  new FormData(form).forEach((value, key) => {
    formData.append(key, value);
  });

  // slug
  const title = $('input[name="title"]').first().val();

  if (title) {
    formData.set("title", title);
    formData.append("slug", createSlug(title));
  }

  // id مقاله
  formData.append("id", id);

  $.ajax({
    url: `${domain}requests/blog/update.php`,
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {

      response = JSON.parse(response);

      if (response.status === 200) {

        Toast.fire({
          icon: "success",
          title: response.text
        });

        setTimeout(() => location.reload(), 2000);

      } else {

        $('#getErrors').html(response.error || response.text);

        Toast.fire({
          icon: response.type || 'error',
          title: response.text
        });

        scroll(150, 1000);
      }
    }
  });

}
function createCategory() {
  let formData = new FormData();

  let title = $('input[name="title"]').val();
  let english_title = $('input[name="english_title"]').val();
  let parentId = $('select[name="parent_id"]').val();
  let image = $('input[name="image"]')[0].files[0];
  let getErrors = document.getElementById("getErrors"); // اگه div مخصوص خطا داری

  formData.append("title", title);
  formData.append("english_title", english_title);
  formData.append("parent_id", parentId);

  // فقط اگه عکس انتخاب شده بود، اضافه می‌کنیم
  if (image) {
    formData.append("image", image);
  }

  $.ajax({
    url: `${domain}requests/category/create.php`,
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        getErrors.innerHTML = "";
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        setTimeout(() => location.reload(), 2000);
      } else {
        getErrors.innerHTML = response.error || "";
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        scroll(150, 1000);
      }
    },
    error: function () {
      Toast.fire({
        icon: "error",
        title: "خطایی در ارتباط با سرور رخ داده است.",
      });
    },
  });
}
function statusCategory(id, status) {
  $.ajax({
    url: `${domain}requests/category/status.php`,
    type: "POST",
    data: {
      id: id,
      status: status
    },
    success: function (response) {
      response = JSON.parse(response);

      if (response.status == 200) {
        // تغییر ظاهر وضعیت
        const statusLabel = document.getElementById("statusShow" + id);
        const statusInput = document.getElementById("changeStatusInput" + id);

        if (status === 1) {
          statusLabel.innerHTML = `
                        <span class="label label-lg font-weight-bold label-light-success label-inline">فعال</span>
                    `;
          statusInput.setAttribute("onclick", `statusCategory(${id}, 2)`);
          statusInput.checked = true;
        } else {
          statusLabel.innerHTML = `
                        <span class="label label-lg font-weight-bold label-light-warning label-inline">غیرفعال</span>
                    `;
          statusInput.setAttribute("onclick", `statusCategory(${id}, 1)`);
          statusInput.checked = false;
        }
        // نمایش پیام موفقیت
        Toast.fire({
          icon: response.type,
          title: response.text + (status === 2 ? ' (زیر‌دسته‌ها هم غیرفعال شدند)' : '')
        });

      } else {
        // پیام خطا
        Toast.fire({
          icon: response.type,
          title: response.text
        });
      }
    },
    error: function () {
      Toast.fire({
        icon: 'error',
        title: 'ارتباط با سرور برقرار نشد'
      });
    }
  });
}
function updateCategory(id) {
  let title = $('input[name="title"]').val(),
      getErrors = document.getElementById("getErrors");
  $.ajax({
    url: `${domain}requests/blogCategory/update.php`,
    type: "POST",
    data: {
      title,
      id,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        getErrors.innerHTML = "";
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      } else {
        getErrors.innerHTML = response.error;
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        scroll(150, 1000);
      }
    },
  });
}
function updateImageCategory(id) {
  let formData = new FormData();
  formData.append("image", $("#inputFile")[0].files[0]);
  formData.append("id", id);
  document.getElementById('uploadedFileName').innerHTML = $("#inputFile")[0].files[0].name;

  $.ajax({
    type: "POST",
    enctype: 'multipart/form-data',
    url: `${domain}requests/category/photo.php`,
    data: formData,
    processData: false,
    contentType: false,
    cache: false,
    timeout: 600000,
    success: function (response) {
      let timerInterval;

      Swal.fire({
        title: 'در حال ویرایش تصویر دسته بندی',
        html: 'لطفا منتظر بمانید',
        timer: 2000,
        timerProgressBar: true,
        didOpen: () => {
          Swal.showLoading();
        },
        willClose: () => {
          clearInterval(timerInterval);
        }
      }).then((result) => {
        response = JSON.parse(response);
        if (response.status == 200) {
          Toast.fire({
            icon: response.type,
            title: response.text,
          });
          document.getElementById("myform").reset();

          let deleteImageBlog = document.querySelector('#deleteImageBlog');
          let deleteImageBlog2 = document.querySelector('#deleteImageBlog2');
          let buttonImage = document.querySelector('#buttonImage');
          let buttonImage2 = document.querySelector('#buttonImage2');

          if (response.oldImage == 'no') {
            deleteImageBlog.classList.remove('d-none');
            buttonImage.classList.remove('d-none');
          }

          if (buttonImage2 && response.oldImage != 'no') {
            buttonImage2.classList.remove('d-none');
            deleteImageBlog2.classList.remove('d-none');
          }

          document.getElementById('imageOld').src = "../../" + response.src;
        } else {
          Toast.fire({
            icon: response.type,
            title: response.text,
          });
        }
      });
    }
  });
}
function updateImageAdvertising(id) {
  let formData = new FormData();
  formData.append("image", $("#inputFile")[0].files[0]);
  formData.append("id", id);
  document.getElementById('uploadedFileName').innerHTML = $("#inputFile")[0].files[0].name;

  $.ajax({
    type: "POST",
    enctype: 'multipart/form-data',
    url: `${domain}requests/banner/photoAdvertising.php`,
    data: formData,
    processData: false,
    contentType: false,
    cache: false,
    timeout: 600000,
    success: function (response) {
      let timerInterval;

      Swal.fire({
        title: 'در حال ویرایش تصویر بنر تبلیغاتی',
        html: 'لطفا منتظر بمانید',
        timer: 2000,
        timerProgressBar: true,
        didOpen: () => {
          Swal.showLoading();
        },
        willClose: () => {
          clearInterval(timerInterval);
        }
      }).then((result) => {
        response = JSON.parse(response);
        if (response.status == 200) {
          Toast.fire({
            icon: response.type,
            title: response.text,
          });
          document.getElementById("myform").reset();

          let deleteImageBlog = document.querySelector('#deleteImageBlog');
          let deleteImageBlog2 = document.querySelector('#deleteImageBlog2');
          let buttonImage = document.querySelector('#buttonImage');
          let buttonImage2 = document.querySelector('#buttonImage2');

          if (response.oldImage == 'no') {
            deleteImageBlog.classList.remove('d-none');
            buttonImage.classList.remove('d-none');
          }
          if (buttonImage2 && response.oldImage != 'no') {
            buttonImage2.classList.remove('d-none');
            deleteImageBlog2.classList.remove('d-none');
          }
          document.getElementById('imageOld').src = "../../" + response.src;
        } else {
          Toast.fire({
            icon: response.type,
            title: response.text,
          });
        }
      });
    }
  });
}
function statusAdvertising(id, status) {
  $.ajax({
    url: `${domain}requests/banner/statusAdvertising.php`,
    type: "POST",
    data: {
      id,
      status,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        if (status === 1) {
          document.getElementById("statusShow" + id).innerHTML = `
                        <span class="label label-lg font-weight-bold label-light-success label-inline">فعال</span>
                    `;
          document
              .getElementById("changeStatusInput" + id)
              .setAttribute(
                  "onclick",
                  `statusAdvertising(${id}, 2)`
              );
        } else {
          document.getElementById("statusShow" + id).innerHTML = `
                        <span class="label label-lg font-weight-bold label-light-warning label-inline">غیر فعال</span>
                    `;
          document
              .getElementById("changeStatusInput" + id)
              .setAttribute(
                  "onclick",
                  `statusAdvertising(${id}, 1)`
              );
        }
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      } else {
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      }
    },
  });
}
$('#parentSelect').on('change', function () {
  var parentId = $(this).val();

  if (parentId) {
    $.ajax({
      url: `${domain}requests/category/selectData.php`,
      type: 'POST',
      data: { parent_id: parentId },
      success: function (response) {
        $('#parentSelectChild').html(response).prop('disabled', false);
        $('#childSelect').html('<option value="">لطفا دسته پدر را انتخاب نمایید</option>').prop('disabled', true);
      }
    });
  } else {
    $('#parentSelectChild').html('<option value="">لطفا دسته اصلی را انتخاب نمایید</option>').prop('disabled', true);
    $('#childSelect').html('<option value="">لطفا دسته پدر را انتخاب نمایید</option>').prop('disabled', true);
  }
});
$('#parentSelectChild').on('change', function () {
  var parentId = $(this).val();

  if (parentId) {
    $.ajax({
      url: `${domain}requests/category/selectSubcategories.php`,
      type: 'POST',
      data: { parent_id: parentId },
      success: function (response) {
        $('#childSelect').html(response).prop('disabled', false);
      }
    });
  } else {
    $('#childSelect').html('<option value="">لطفا دسته پدر را انتخاب نمایید</option>').prop('disabled', true);
  }
});
function createProduct() {
  const form = document.getElementById('productForm');
  const imageInput = document.getElementById('imageInput');
  const mainImageIndex = document.getElementById('mainImageIndex').value;
  const formData = new FormData();
  // گرفتن فیلدهای معمولی فرم (به جز فایل‌ها)
  new FormData(form).forEach((value, key) => {
    if (key !== 'images[]') {
      formData.append(key, value);
    }
  });
  // اضافه کردن فایل‌های انتخاب‌شده از imageFiles
  if (imageFiles.length === 0) {
    alert("حداقل یک تصویر باید انتخاب شود.");
    return;
  }
  if (imageFiles.length > 5) {
    alert("حداکثر ۵ تصویر مجاز است.");
    return;
  }

  imageFiles.forEach(file => {
    formData.append('images[]', file);
  });

  // افزودن مقدار انتخاب‌شده به عنوان تصویر اصلی
  formData.append('main_image_index', mainImageIndex);

  // تولید اسلاگ از عنوان محصول
  const title = $('input[name="title"]').val();
  if (title) {
    formData.append("slug", createSlug(title));
    formData.append("title", title);
  }

  // ارسال AJAX
  $.ajax({
    url: `${domain}requests/products/create.php`,
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      response = JSON.parse(response);
      if (response.status === 200) {
        Toast.fire({ icon: 'success', title: response.text });
        setTimeout(() => location.reload(), 2000);
      } else {
        $('#getErrors').html(response.error || response.text);
        Toast.fire({ icon: response.type || 'error', title: response.text });
        scroll(150, 1000);
      }
    }
  });
}
function updateProduct(id) {
  const form = document.getElementById('productForm');
  const mainImageIndex = document.getElementById('mainImageIndex').value;
  const formData = new FormData();

  // گرفتن فیلدهای فرم (main_image_index جداگانه اضافه می‌شود تا مقدار صحیح ارسال شود)
  new FormData(form).forEach((value, key) => {
    if (key !== 'main_image_index' && key !== 'images[]') {
      formData.append(key, value);
    }
  });

  // تصاویر جدید
  if (imageFiles.length > 0) {
    imageFiles.forEach(file => {
      formData.append('images[]', file);
    });
  }

  // تصاویر حذف‌شده
  if (deletedImages.length > 0) {
    formData.append("deleted_images", deletedImages.join(","));
  }

  // تصویر اصلی - مقدار به‌روز از hidden input
  var mainImageIdxEl = document.getElementById('mainImageIndex');
  formData.append('main_image_index', mainImageIdxEl ? mainImageIdxEl.value : (mainImageIndex || '0'));

  // slug
  const title = $('input[name="title"]').val();
  const child_id = $('select[name="child_id"]').val();
  if (title) {
    formData.append("slug", createSlug(title));
    formData.append("title", title);
    formData.append("child_id", child_id);
  }
  // آی‌دی محصول
  formData.append("id", id);

  // ارسال AJAX
  $.ajax({
    url: `${domain}requests/products/update.php`,
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      response = JSON.parse(response);
      if (response.status === 200) {
        Toast.fire({ icon: 'success', title: response.text });
        setTimeout(() => location.reload(), 2000);
      } else {
        $('#getErrors').html(response.error || response.text);
        Toast.fire({ icon: response.type || 'error', title: response.text });
        scroll(150, 1000);
      }
    }
  });
}
function createForwarding() {
  let min_weight = $('input[name="min_weight"]').val(),
      max_weight = $('input[name="max_weight"]').val(),
      base_post_cost = $('input[name="base_post_cost"]').val(),
      insurance_cost = $('input[name="insurance_cost"]').val(),
      added_value_tax = $('input[name="added_value_tax"]').val(),
      getErrors = document.getElementById("getErrors");
  $.ajax({
    url: `${domain}requests/forwarding/create.php`,
    type: "POST",
    data: {
      min_weight,
      max_weight,
      base_post_cost,
      insurance_cost,
      added_value_tax,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        getErrors.innerHTML = "";
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        setTimeout(() => location.replace("management"), 3000);
      } else {
        getErrors.innerHTML = response.error;
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        scroll(150, 1000);
      }
    },
  });
}
function deleteForwarding(Id) {
  $.ajax({
    url: `${domain}requests/forwarding/delete.php`,
    type: "POST",
    data: {
      Id,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        document.getElementById('deleteForwarding'+Id).style.display="none";
      } else {
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      }
    },
  });
}
function previewAppointmentSlots() {
  let start = $('select[name="start_time"]').val();
  let end = $('select[name="end_time"]').val();
  let duration = parseInt($('select[name="slot_duration"]').val(), 10) || 30;
  let capacity = parseInt($('input[name="capacity_per_slot"]').val(), 10) || 1;
  let step = Math.max(1, Math.floor(duration / Math.max(1, capacity)));
  let preview = document.getElementById("appointmentSlotsPreview");
  if (!preview || !start || !end) {
    return;
  }

  let startParts = start.split(":").map(Number);
  let endParts = end.split(":").map(Number);
  let startMinutes = startParts[0] * 60 + startParts[1];
  let endMinutes = endParts[0] * 60 + endParts[1];

  if (startMinutes >= endMinutes || step <= 0) {
    preview.innerHTML = '<span class="text-muted">ساعت معتبری برای نمایش وجود ندارد.</span>';
    return;
  }

  let html = "";
  for (let m = startMinutes; m < endMinutes; m += step) {
    let h = Math.floor(m / 60);
    let min = m % 60;
    let label =
      String(h).padStart(2, "0") + ":" + String(min).padStart(2, "0");
    html +=
      '<span class="label label-lg label-light-primary label-inline m-1 px-4 py-3">' +
      label +
      "</span>";
  }
  preview.innerHTML = html || '<span class="text-muted">ساعت معتبری برای نمایش وجود ندارد.</span>';
}

function updateAppointmentSettings(id) {
  let start_time = $('select[name="start_time"]').val(),
    end_time = $('select[name="end_time"]').val(),
    slot_duration = $('select[name="slot_duration"]').val(),
    capacity_per_slot = $('input[name="capacity_per_slot"]').val(),
    price = $('input[name="price"]').val(),
    status = $('select[name="status"]').val(),
    working_days = [],
    getErrors = document.getElementById("getErrors");

  $('input[name="working_days[]"]:checked').each(function () {
    working_days.push($(this).val());
  });

  $.ajax({
    url: `${domain}requests/appointment/update.php`,
    type: "POST",
    data: {
      id,
      start_time,
      end_time,
      slot_duration,
      capacity_per_slot,
      price,
      status,
      working_days,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        getErrors.innerHTML = "";
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        if (response.slots && Array.isArray(response.slots)) {
          let preview = document.getElementById("appointmentSlotsPreview");
          if (preview) {
            preview.innerHTML = response.slots
              .map(function (slot) {
                return (
                  '<span class="label label-lg label-light-primary label-inline m-1 px-4 py-3">' +
                  slot +
                  "</span>"
                );
              })
              .join("");
          }
        }
      } else {
        getErrors.innerHTML = response.error || "";
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        scroll(150, 1000);
      }
    },
  });
}
function updateContactUs(id) {
  let email = $('input[name="email"]').val(),
      post_code = $('input[name="post_code"]').val(),
      address = $('input[name="address"]').val(),
      working_hours	 = $('input[name="working_hours"]').val(),
      getErrors = document.getElementById("getErrors");
  $.ajax({
    url: `${domain}requests/contactUs/update.php`,
    type: "POST",
    data: {
      email,
      post_code,
      address,
      working_hours,
      id,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        getErrors.innerHTML = "";
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      } else {
        getErrors.innerHTML = response.error;
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        scroll(150, 1000);
      }
    },
  });
}
function createCoupons() {
  let code = $('input[name="code"]').val(),
      discount_value = $('input[name="discount_value"]').val(),
      discount_type = $('input[name="discount_type"]:checked').val(),
      start_date = $('input[name="start_date"]').val(),
      end_date = $('input[name="end_date"]').val(),
      usage_limit = $('input[name="usage_limit"]').val(),
      min_purchase = $('input[name="min_purchase"]').val(),
      once_per_user = $('input[name="once_per_user"]').is(':checked') ? 1 : 0,
      getErrors = document.getElementById("getErrors");
  $.ajax({
    url: `${domain}requests/coupons/create.php`,
    type: "POST",
    data: {
      code,
      discount_value,
      discount_type,
      start_date,
      end_date,
      usage_limit,
      min_purchase,
      once_per_user,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        getErrors.innerHTML = "";
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        setTimeout(() => location.replace("management"), 3000);
      } else {
        getErrors.innerHTML = response.error;
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        scroll(150, 1000);
      }
    },
  });
}
function statusCantactUs(id, status) {
  $.ajax({
    url: `${domain}requests/contactUs/status.php`,
    type: "POST",
    data: {
      id,
      status,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        if (status === 1) {
          document.getElementById("statusShow" + id).innerHTML = `
                        <span class="label label-lg font-weight-bold label-light-success label-inline">فعال</span>
                    `;
          document
              .getElementById("changeStatusInput" + id)
              .setAttribute(
                  "onclick",
                  `statusCantactUs(${id}, 2)`
              );
        } else {
          document.getElementById("statusShow" + id).innerHTML = `
                        <span class="label label-lg font-weight-bold label-light-warning label-inline">غیر فعال</span>
                    `;
          document
              .getElementById("changeStatusInput" + id)
              .setAttribute(
                  "onclick",
                  `statusCantactUs(${id}, 1)`
              );
        }
        Toast.fire({
          icon: response.type,
          title: response.text,
        });

        location.replace('management');
      } else {
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      }
    },
  });
}
function createBanner() {
  let link = $('input[name="link"]').val(),
      type = $('select[name="type"]').val(),
      image = $('input[name="image"]')[0].files[0],
      getErrors = document.getElementById("getErrors");
  let formData = new FormData();
  formData.append("link", link);
  formData.append("type", type);
  if (image) {
    formData.append("image", image);
  }
  $.ajax({
    url: `${domain}requests/banner/create.php`,
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      response = JSON.parse(response);
      if (response.status === 200) {
        getErrors.innerHTML = "";
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        setTimeout(() => location.replace("management"), 3000);
      } else {
        getErrors.innerHTML = response.error;
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        scroll(150, 1000);
      }
    },
  });
}
function updateBanner(id) {
  let link = $('input[name="link"]').val(),
      type = $('select[name="type"]').val(),
      getErrors = document.getElementById("getErrors");
  $.ajax({
    url: `${domain}requests/banner/update.php`,
    type: "POST",
    data: {
      link,
      type,
      id,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        getErrors.innerHTML = "";
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      } else {
        getErrors.innerHTML = response.error;
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        scroll(150, 1000);
      }
    },
  });
}
function updateBannerAdvertising(id) {
  let link = $('input[name="link"]').val(),
      title = $('input[name="title"]').val(),
      description = $('input[name="description"]').val(),
      getErrors = document.getElementById("getErrors");
  $.ajax({
    url: `${domain}requests/banner/updateAdvertising.php`,
    type: "POST",
    data: {
      link,
      title,
      description,
      id,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        getErrors.innerHTML = "";
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      } else {
        getErrors.innerHTML = response.error;
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        scroll(150, 1000);
      }
    },
  });
}
function updateLink(id) {
  let link = $('input[name="link"]').val(),
      getErrors = document.getElementById("getErrors");
  $.ajax({
    url: `${domain}requests/information/updateLink.php`,
    type: "POST",
    data: {
      link,
      id
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        getErrors.innerHTML = "";
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      } else {
        getErrors.innerHTML = response.error;
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        scroll(150, 1000);
      }
    },
  });
}
function statusLink(id, status) {
  $.ajax({
    url: `${domain}requests/information/statusLink.php`,
    type: "POST",
    data: {
      id,
      status,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        if (status === 1) {
          document.getElementById("statusShow" + id).innerHTML = `
                        <span class="label label-lg font-weight-bold label-light-success label-inline">فعال</span>
                    `;
          document
              .getElementById("changeStatusInput" + id)
              .setAttribute(
                  "onclick",
                  `statusLink(${id}, 2)`
              );
        } else {
          document.getElementById("statusShow" + id).innerHTML = `
                        <span class="label label-lg font-weight-bold label-light-warning label-inline">غیر فعال</span>
                    `;
          document
              .getElementById("changeStatusInput" + id)
              .setAttribute(
                  "onclick",
                  `statusLink(${id}, 1)`
              );
        }
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      } else {
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      }
    },
  });
}
function AddTicketDetails(ticketId) {
  let formData = new FormData();
  formData.append("fileUrl", $("#inputFile")[0].files[0]);
  formData.append("text", $('input[name="text"]').val());
  formData.append("ticketId", ticketId);
  $.ajax({
    enctype: "multipart/form-data",
    url: `${domain}requests/tickets/addTicketDetails.php`,
    type: "POST",
    processData: false,
    contentType: false,
    cache: false,
    data: formData,
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        let downloadFile = "";
        if (response.fileUrl)
          downloadFile = `
             <a href="/admin/downloadFile?id=${response.id}">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256"><path d="M213.66,82.34l-56-56A8,8,0,0,0,152,24H56A16,16,0,0,0,40,40V216a16,16,0,0,0,16,16H200a16,16,0,0,0,16-16V88A8,8,0,0,0,213.66,82.34ZM160,51.31,188.69,80H160ZM200,216H56V40h88V88a8,8,0,0,0,8,8h48V216Zm-42.34-61.66a8,8,0,0,1,0,11.32l-24,24a8,8,0,0,1-11.32,0l-24-24a8,8,0,0,1,11.32-11.32L120,164.69V120a8,8,0,0,1,16,0v44.69l10.34-10.35A8,8,0,0,1,157.66,154.34Z"></path></svg>
            </a>
        `;
        if (!response.textTicket) {
          response.textTicket = "";
        }
        document.getElementById("ticket").innerHTML += `
         <div class="mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px" style="margin:0px auto 0px 0px;">
            <div class="d-flex align-items-center">
            </div>
            <div class="">
             ${response.textTicket}
             ${downloadFile}
            </div>
            <div style="font-size: 10px;margin:10px 0px 0px 0px;">
            ${response.date_org}
            </div>
        `;
        document.getElementById('textMasseg').value = "";
      } else {
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      }
    },
  });
}
function statusTicket(id, status) {
  $.ajax({
    url: `${domain}requests/tickets/status.php`,
    type: "POST",
    data: {
      id,
      status,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        if (status === 1) {
          document.getElementById("statusShow" + id).innerHTML = `
                        <span class="label label-lg font-weight-bold label-light-success label-inline">باز</span>
                    `;
          document
              .getElementById("changeStatusInput" + id)
              .setAttribute(
                  "onclick",
                  `statusTicket(${id}, 2)`
              );
        } else {
          document.getElementById("statusShow" + id).innerHTML = `
                        <span class="label label-lg font-weight-bold label-light-warning label-inline">بسته شد</span>
                    `;
          document
              .getElementById("changeStatusInput" + id)
              .setAttribute(
                  "onclick",
                  `statusTicket(${id}, 1)`
              );
        }
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      } else {
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      }
    },
  });
}
function statusUser(id, status) {
  $.ajax({
    url: `${domain}requests/user/status.php`,
    type: "POST",
    data: {
      id,
      status,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        if (status === 1) {
          document.getElementById("statusShow" + id).innerHTML = `
                        <span class="label label-lg font-weight-bold label-light-success label-inline">فعال</span>
                    `;
          document
              .getElementById("changeStatusInput" + id)
              .setAttribute(
                  "onclick",
                  `statusUser(${id}, 2)`
              );
        } else {
          document.getElementById("statusShow" + id).innerHTML = `
                        <span class="label label-lg font-weight-bold label-light-warning label-inline">غیر فعال</span>
                    `;
          document
              .getElementById("changeStatusInput" + id)
              .setAttribute(
                  "onclick",
                  `statusUser(${id}, 1)`
              );
        }
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      } else {
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      }
    },
  });
}
function updateCoupon(id) {

  let code = $('input[name="code"]').val(),
      discount_type = $('input[name="discount_type"]:checked').val(),
      discount_value = $('input[name="discount_value"]').val(),
      start_date = $('input[name="start_date"]').val(),
      end_date = $('input[name="end_date"]').val(),
      usage_limit = $('input[name="usage_limit"]').val(),
      min_purchase = $('input[name="min_purchase"]').val(),
      once_per_user = $('input[name="once_per_user"]').is(':checked') ? 1 : 0,
      getErrors = document.getElementById("getErrors");
  $.ajax({
    url: `${domain}requests/coupons/update.php`,
    type: "POST",
    data: {
      id: id,
      code: code,
      discount_type: discount_type,
      discount_value: discount_value,
      start_date: start_date,
      end_date: end_date,
      usage_limit: usage_limit,
      min_purchase: min_purchase,
      once_per_user: once_per_user,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        getErrors.innerHTML = "";
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      } else {
        getErrors.innerHTML = response.error ?? '';
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        scroll(150, 1000);
      }
    }
  });
}
function statusCopens(id, status) {
  $.ajax({
    url: `${domain}requests/coupons/status.php`,
    type: "POST",
    data: {
      id,
      status,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        if (status === 1) {
          document.getElementById("statusShow" + id).innerHTML = `
                        <span class="label label-lg font-weight-bold label-light-success label-inline">فعال</span>
                    `;
          document
              .getElementById("changeStatusInput" + id)
              .setAttribute(
                  "onclick",
                  `statusCopens(${id}, 2)`
              );
        } else {
          document.getElementById("statusShow" + id).innerHTML = `
                        <span class="label label-lg font-weight-bold label-light-warning label-inline">غیر فعال</span>
                    `;
          document
              .getElementById("changeStatusInput" + id)
              .setAttribute(
                  "onclick",
                  `statusCopens(${id}, 1)`
              );
        }
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      } else {
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      }
    },
  });
}
function changeOrderStatus(orderId, status) {
  $.ajax({
    url: `${domain}requests/order/changeStatus.php`,
    type: "POST",
    data: {
      id: orderId,
      status: status,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        // آپدیت وضعیت در جدول
        let labelHtml = "";
        if (status == 1) {
          labelHtml = `<span class="label label-lg font-weight-bold label-light-success label-inline">مرسوله رسیده</span>`;
        } else if (status == 2) {
          labelHtml = `<span class="label label-lg font-weight-bold label-light-primary label-inline">مرسوله در دست پست </span>`;
        } else if (status == 3) {
          labelHtml = `<span class="label label-lg font-weight-bold label-light-danger label-inline">درحال بسته بندی</span>`;
        } else if (status == 4) {
          labelHtml = `<span class="label label-lg font-weight-bold label-light-info label-inline">منتظر تایید</span>`;
        }

        // فرض بر اینکه تگ وضعیت جدول idش اینه:
        document.getElementById("statusShow" + orderId).innerHTML = labelHtml;

        // بستن مودال
        $('#exampleModal').modal('hide');

        // Toast
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      } else {
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      }
    },
    error: function () {
      Toast.fire({
        icon: 'error',
        title: 'خطا در اتصال به سرور',
      });
    }
  });
}
function changeAppointmentStatus(appointmentId, status) {
  $.ajax({
    url: `${domain}requests/appointment/changeStatus.php`,
    type: "POST",
    data: {
      id: appointmentId,
      status: status,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        const adminStatus = document.getElementById("appointmentAdminStatus" + appointmentId);
        const finalStatus = document.getElementById("appointmentFinalStatus" + appointmentId);

        if (adminStatus && response.adminStatusHtml) {
          adminStatus.innerHTML = response.adminStatusHtml;
        }
        if (finalStatus && response.finalStatusHtml) {
          finalStatus.innerHTML = response.finalStatusHtml;
        }

        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      } else {
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      }
    },
    error: function () {
      Toast.fire({
        icon: "error",
        title: "خطا در اتصال به سرور",
      });
    },
  });
}
function createShippingPost(orderId) {
  let shipping_code = $('input[name="shipping_code"]').val(),
      getErrors = document.getElementById("getErrors");
  $.ajax({
    url: `${domain}requests/order/createShippingCode.php`,
    type: "POST",
    data: {
      shipping_code,
      orderId
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        getErrors.innerHTML = "";
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        document.getElementById('shipping_code'+orderId).innerText=response.shipping_code;
        //setTimeout(() => location.replace("management"), 3000);
      } else {
        getErrors.innerHTML = response.error;
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      }
    },
  });
}
function updatePages(id) {
  let title_page = $('input[name="title_page"]').val(),
      keywords = $('input[name="keywords"]').val(),
      description = $('input[name="description"]').val(),
      schema = $('input[name="schema"]').val(),
      getErrors = document.getElementById("getErrors");
  $.ajax({
    url: `${domain}requests/pages/update.php`,
    type: "POST",
    data: {
      title_page,
      keywords,
      description,
      schema,
      id
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        getErrors.innerHTML = "";
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      } else {
        getErrors.innerHTML = response.error;
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        scroll(150, 1000);
      }
    },
  });
}
function updateComment(id) {
  let text_admin = $('textarea[name="text_admin"]').val(),
      getErrors = document.getElementById("getErrors");
  $.ajax({
    url: `${domain}requests/comment/update.php`,
    type: "POST",
    data: {
      text_admin,
      id
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        getErrors.innerHTML = "";
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      } else {
        getErrors.innerHTML = response.error;
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        scroll(150, 1000);
      }
    },
  });
}
function statusComment(id, status) {
    $.ajax({
        url: `${domain}requests/comment/status.php`,
        type: "POST",
        data: {
            id,
            status,
        },
        success: function (response) {
            response = JSON.parse(response);
            if (response.status == 200) {
                if (status === 1) {
                    document.getElementById("statusShow" + id).innerHTML = `
                        <span class="label label-lg font-weight-bold label-light-success label-inline">فعال</span>
                    `;
                    document
                        .getElementById("changeStatusInput" + id)
                        .setAttribute(
                            "onclick",
                            `statusComment(${id}, 2)`
                        );
                } else {
                    document.getElementById("statusShow" + id).innerHTML = `
                        <span class="label label-lg font-weight-bold label-light-warning label-inline">غیر فعال</span>
                    `;
                    document
                        .getElementById("changeStatusInput" + id)
                        .setAttribute(
                            "onclick",
                            `statusComment(${id}, 1)`
                        );
                }
                Toast.fire({
                    icon: response.type,
                    title: response.text,
                });
            } else {
                Toast.fire({
                    icon: response.type,
                    title: response.text,
                });
            }
        },
    });
}
function exportDayliSales() {
  $.ajax({
    url: `${domain}requests/reports/check-dayli-export.php`,
    type: "POST",
    success: function (res) {
      res = JSON.parse(res);
      if (res.status === 200) {
        console.log('/');
        window.location.href =
            `${domain}admin/reports/dayli`;
      }
    }
  });
}
function updateCategorySort(id, newSort) {

  newSort = parseInt(newSort);

  let currentRow = $('tr[data-id="' + id + '"]');
  let oldSort = parseInt(currentRow.data('sort'));

  $.ajax({
    url: `${domain}requests/category/update-sort.php`,
    type: "POST",
    data: {
      id: id,
      sort: newSort
    },
    success: function (response) {

      response = JSON.parse(response);

      if (response.status !== 200) {
        Toast.fire({
          icon: 'error',
          title: 'خطا در ذخیره ترتیب'
        });

        // rollback
        currentRow.find('input[type=number]').val(oldSort);
        return;
      }

      /**
       * پیدا کردن ردیفی که sort جدید رو داشته
       */
      let targetRow = $('tr[data-sort="' + newSort + '"]');

      if (targetRow.length) {

        // جابه‌جایی ردیف‌ها
        if (newSort > oldSort) {
          targetRow.after(currentRow);
        } else {
          targetRow.before(currentRow);
        }

        // آپدیت sort ردیف دوم
        targetRow
            .data('sort', oldSort)
            .find('input[type=number]').val(oldSort);
      }

      // آپدیت sort ردیف فعلی
      currentRow.data('sort', newSort);

      Toast.fire({
        icon: 'success',
        title: 'ترتیب نمایش با موفقیت ذخیره شد'
      });
    }
  });
}
function typeCategory(id, status) {
  $.ajax({
    url: `${domain}requests/category/type.php`,
    type: "POST",
    data: {
      id: id,
      status: status
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        // تغییر ظاهر وضعیت
        const statusLabel = document.getElementById("typeShow" + id);
        const statusInput = document.getElementById("changeStatusInputType" + id);
        if (status === 1) {
          statusLabel.innerHTML = `
                        <span class="label label-lg font-weight-bold label-light-success label-inline">نمایش</span>
                    `;
          statusInput.setAttribute("onclick", `typeCategory(${id}, 2)`);
          statusInput.checked = true;
        } else {
          statusLabel.innerHTML = `
                        <span class="label label-lg font-weight-bold label-light-warning label-inline">عدم نمایش</span>
                    `;
          statusInput.setAttribute("onclick", `typeCategory(${id}, 1)`);
          statusInput.checked = false;
        }
        Toast.fire({
          icon: response.type,
          title: response.text + (status === 2 ? ' (زیر‌دسته‌ها هم غیرفعال شدند)' : '')
        });
      } else {
        // پیام خطا
        Toast.fire({
          icon: response.type,
          title: response.text
        });
      }
    },
    error: function () {
      Toast.fire({
        icon: 'error',
        title: 'ارتباط با سرور برقرار نشد'
      });
    }
  });
}
function createNotifications() {
  let title = $('input[name="title"]').val(),
      description = $('input[name="description"]').val(),
      getErrors = document.getElementById("getErrors");
  $.ajax({
    url: `${domain}requests/notifications/create.php`,
    type: "POST",
    data: {
      title,
      description,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        getErrors.innerHTML = "";
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        setTimeout(() => location.replace("management"), 3000);
      } else {
        getErrors.innerHTML = response.error;
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        scroll(150, 1000);
      }
    },
  });
}
function statusNotifications(id, status) {
  $.ajax({
    url: `${domain}requests/notifications/status.php`,
    type: "POST",
    data: {
      id,
      status,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        if (status === 1) {
          document.getElementById("statusShow" + id).innerHTML = `
                        <span class="label label-lg font-weight-bold label-light-success label-inline">فعال</span>
                    `;
          document
              .getElementById("changeStatusInput" + id)
              .setAttribute(
                  "onclick",
                  `statusNotifications(${id}, 2)`
              );
        } else {
          document.getElementById("statusShow" + id).innerHTML = `
                        <span class="label label-lg font-weight-bold label-light-warning label-inline">غیر فعال</span>
                    `;
          document
              .getElementById("changeStatusInput" + id)
              .setAttribute(
                  "onclick",
                  `statusNotifications(${id}, 1)`
              );
        }
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      } else {
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      }
    },
  });
}
function delteNotifications(Id) {

  $.ajax({
    url: `${domain}requests/notifications/delete.php`,
    type: "POST",
    data: {
      Id,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        document.getElementById('deleteNotifications'+Id).style.display="none";
      } else {
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      }
    },
  });
}
function updateImageCategoryBlog(id) {
  let formData = new FormData();
  formData.append("image", $("#inputFile")[0].files[0]);
  formData.append("id", id);
  document.getElementById('uploadedFileName').innerHTML = $("#inputFile")[0].files[0].name;

  $.ajax({
    type: "POST",
    enctype: 'multipart/form-data',
    url: `${domain}requests/blogCategory/photo.php`,
    data: formData,
    processData: false,
    contentType: false,
    cache: false,
    timeout: 600000,
    success: function (response) {
      let timerInterval;

      Swal.fire({
        title: 'در حال ویرایش تصویر دسته بندی مقالات',
        html: 'لطفا منتظر بمانید',
        timer: 2000,
        timerProgressBar: true,
        didOpen: () => {
          Swal.showLoading();
        },
        willClose: () => {
          clearInterval(timerInterval);
        }
      }).then((result) => {
        response = JSON.parse(response);
        if (response.status == 200) {
          Toast.fire({
            icon: response.type,
            title: response.text,
          });
          document.getElementById("myform").reset();

          let deleteImageBlog = document.querySelector('#deleteImageBlog');
          let deleteImageBlog2 = document.querySelector('#deleteImageBlog2');
          let buttonImage = document.querySelector('#buttonImage');
          let buttonImage2 = document.querySelector('#buttonImage2');

          if (response.oldImage == 'no') {
            deleteImageBlog.classList.remove('d-none');
            buttonImage.classList.remove('d-none');
          }
          if (buttonImage2 && response.oldImage != 'no') {
            buttonImage2.classList.remove('d-none');
            deleteImageBlog2.classList.remove('d-none');
          }
          document.getElementById('imageOld').src = "../../" + response.src;
        } else {
          Toast.fire({
            icon: response.type,
            title: response.text,
          });
        }
      });
    }
  });
}
function createTrust() {
  let title = $('input[name="title"]').val(),
      description = $('input[name="description"]').val(),
      image = $('input[name="image"]')[0].files[0],
      getErrors = document.getElementById("getErrors");
  let formData = new FormData();
  formData.append("title", title);
  formData.append("description", description);
  if (image) {
    formData.append("image", image);
  }
  $.ajax({
    url: `${domain}requests/trust/create.php`,
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      response = JSON.parse(response);
      if (response.status === 200) {
        getErrors.innerHTML = "";
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        setTimeout(() => location.replace("management"), 3000);
      } else {
        getErrors.innerHTML = response.error;
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        scroll(150, 1000);
      }
    },
  });
}
function statusTrust(id, status) {
  $.ajax({
    url: `${domain}requests/trust/status.php`,
    type: "POST",
    data: {
      id,
      status,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        if (status === 1) {
          document.getElementById("statusShow" + id).innerHTML = `
                        <span class="label label-lg font-weight-bold label-light-success label-inline">فعال</span>
                    `;
          document
              .getElementById("changeStatusInput" + id)
              .setAttribute(
                  "onclick",
                  `statusTrust(${id}, 2)`
              );
        } else {
          document.getElementById("statusShow" + id).innerHTML = `
                        <span class="label label-lg font-weight-bold label-light-warning label-inline">غیر فعال</span>
                    `;
          document
              .getElementById("changeStatusInput" + id)
              .setAttribute(
                  "onclick",
                  `statusTrust(${id}, 1)`
              );
        }
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      } else {
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      }
    },
  });
}
function delteTrust(Id) {

  $.ajax({
    url: `${domain}requests/trust/delete.php`,
    type: "POST",
    data: {
      Id,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        document.getElementById('deleteTrust'+Id).style.display="none";
      } else {
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      }
    },
  });
}
function AddNewTicketAdmin($userId) {
  let formData = new FormData();
  formData.append("fileUrl", $("#dropzone-file")[0].files[0]);
  formData.append("text", $('input[name="text"]').val());
  formData.append("title", $('input[name="title"]').val());
  formData.append("userId", $userId);
  $.ajax({
    enctype: "multipart/form-data",
    url: `${domain}requests/tickets/createNewTicketAdmin.php`,
    type: "POST",
    processData: false,
    contentType: false,
    cache: false,
    data: formData,
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        setTimeout(() => location.replace("/admin/tickets/management"), 2000);
      } else {
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      }
    },
  });
}
function createBlog() {
  const form = document.getElementById('blogId');
  const titleInput = form.querySelector('input[name="title"]');
  const imageInput = form.querySelector('input[name="image"]');
  // بررسی انتخاب تصویر
  if (!imageInput.files || imageInput.files.length === 0) {
    $('#imageError').text('لطفاً یک تصویر برای مقاله انتخاب کنید.');

    Toast.fire({
      icon: 'warning',
      title: 'لطفاً تصویر مقاله را انتخاب کنید.'
    });

    return;
  }
  const imageFile = imageInput.files[0];

  // محدودیت حجم تصویر، در صورت نیاز
  const maxFileSize = 5 * 1024 * 1024; // پنج مگابایت

  if (imageFile.size > maxFileSize) {
    $('#imageError').text('حجم تصویر نباید بیشتر از ۵ مگابایت باشد.');

    Toast.fire({
      icon: 'warning',
      title: 'حجم تصویر زیاد است.'
    });

    return;
  }

  const formData = new FormData(form);

  // دریافت متن Summernote
  let description = '';

  if ($('#productDescription').hasClass('summernote')) {
    description = $('#productDescription').summernote('code');
  } else {
    description = $('#productDescription').val();
  }

  formData.set('description', description);

  // تولید اسلاگ از عنوان مقاله
  const title = titleInput.value.trim();

  if (typeof createSlug === 'function') {
    formData.set('slug', createSlug(title));
  }

  // اطمینان از ارسال یک فایل با نام image
  formData.delete('images[]');
  formData.delete('images');
  formData.delete('image');
  formData.append('image', imageFile);

  $.ajax({
    url: `${domain}requests/blog/create.php`,
    type: 'POST',
    data: formData,
    processData: false,
    contentType: false,

    beforeSend: function () {
      $('.btn-primary')
          .prop('disabled', true)
          .addClass('disabled');

      Toast.fire({
        icon: 'info',
        title: 'در حال ایجاد مقاله...'
      });
    },

    success: function (response) {
      let result;

      try {
        result = typeof response === 'string'
            ? JSON.parse(response)
            : response;
      } catch (error) {
        console.error('پاسخ نامعتبر از سرور:', response);

        Toast.fire({
          icon: 'error',
          title: 'پاسخ سرور نامعتبر است.'
        });

        return;
      }

      if (Number(result.status) === 200) {
        Toast.fire({
          icon: 'success',
          title: result.text || 'مقاله با موفقیت ایجاد شد.'
        });

        setTimeout(function () {
          location.reload();
        }, 2000);

        return;
      }

      $('#getErrors').html(
          result.error || result.text || 'ایجاد مقاله انجام نشد.'
      );

      Toast.fire({
        icon: result.type || 'error',
        title: result.text || 'خطایی رخ داده است.'
      });

      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    },

    error: function (xhr, status, error) {
      console.error('AJAX Error:', {
        status: status,
        error: error,
        response: xhr.responseText
      });

      Toast.fire({
        icon: 'error',
        title: 'خطا در ارتباط با سرور رخ داد.'
      });
    },

    complete: function () {
      $('.btn-primary')
          .prop('disabled', false)
          .removeClass('disabled');
    }
  });
}
function updateImageBannerBlog(id) {
  let formData = new FormData();
  formData.append("image", $("#inputFile")[0].files[0]);
  formData.append("id", id);
  document.getElementById('uploadedFileName').innerHTML = $("#inputFile")[0].files[0].name;

  $.ajax({
    type: "POST",
    enctype: 'multipart/form-data',
    url: `${domain}requests/blog/banner.php`,
    data: formData,
    processData: false,
    contentType: false,
    cache: false,
    timeout: 600000,
    success: function (response) {
      let timerInterval;

      Swal.fire({
        title: 'در حال ویرایش تصویر بنر تبلیغاتی',
        html: 'لطفا منتظر بمانید',
        timer: 2000,
        timerProgressBar: true,
        didOpen: () => {
          Swal.showLoading();
        },
        willClose: () => {
          clearInterval(timerInterval);
        }
      }).then((result) => {
        response = JSON.parse(response);
        if (response.status == 200) {
          Toast.fire({
            icon: response.type,
            title: response.text,
          });
          document.getElementById("myform").reset();

          let deleteImageBlog = document.querySelector('#deleteImageBlog');
          let deleteImageBlog2 = document.querySelector('#deleteImageBlog2');
          let buttonImage = document.querySelector('#buttonImage');
          let buttonImage2 = document.querySelector('#buttonImage2');

          if (response.oldImage == 'no') {
            deleteImageBlog.classList.remove('d-none');
            buttonImage.classList.remove('d-none');
          }
          if (buttonImage2 && response.oldImage != 'no') {
            buttonImage2.classList.remove('d-none');
            deleteImageBlog2.classList.remove('d-none');
          }
          document.getElementById('imageOld').src = "../../" + response.src;
        } else {
          Toast.fire({
            icon: response.type,
            title: response.text,
          });
        }
      });
    }
  });
}
function updateLinkBlog(id) {
  let link_blog = $('input[name="link_blog"]').val(),
      getErrors = document.getElementById("getErrors");
  $.ajax({
    url: `${domain}requests/blog/updateLink.php`,
    type: "POST",
    data: {
      link_blog,
      id,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        getErrors.innerHTML = "";
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      } else {
        getErrors.innerHTML = response.error;
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        scroll(150, 1000);
      }
    },
  });
}

