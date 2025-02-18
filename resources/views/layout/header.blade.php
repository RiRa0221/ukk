<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sales</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('tmp/src/assets/images/logos/favicon.png') }}" />
  <link rel="stylesheet" href="{{ asset('tmp/src/assets/css/styles.min.css') }}" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('auth/style1.css') }}">


  <style>
    body {
      background-color: #fff; /* Putih */
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
    }

/* Sidebar dengan latar belakang transparan pink pekat */
    .left-sidebar {
      position: fixed;
      top: 0;
      left: 0;
      height: 100vh;
      width: 270px; /* Menambah lebar sidebar */
      background:rgb(251, 142, 198); /* Pink pekat transparan */
      z-index: 1050;
      transition: all 0.3s ease;
      margin-top: 0;
    }

    .left-sidebar .sidebar-nav {
      position: relative;
      z-index: 1060;
    }

    .pink-bg {
      background-color: rgb(251, 142, 198) !important;
    }


    /* Navbar dengan efek blur pada latar belakang */
    .app-header {
      background: rgb(251, 142, 198); /* Pink pekat transparan */
      backdrop-filter: blur(10px); /* Efek blur pada latar belakang navbar */
    }

    .app-header .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      width: 100%;
      padding: 0;
    }

    /* Navbar Item */
    .navbar-nav {
      display: flex;
      align-items: center;
      margin-left: 0;
    }

    .navbar-nav a {
      color: #fff; /* Putih */
      margin-left: 20px;
      font-weight: bold;
    }

    .navbar-nav a:hover {
      color: #b0003a; /* Pink lebih gelap */
    }

    /* Sidebar item */
    .sidebar-item {
      border-bottom: 1px solid rgba(255, 255, 255, 0.3);
    }

    .sidebar-item a {
      color: #fff; /* Putih */
      font-weight: bold;
    }

    .sidebar-item a:hover {
      color: #b0003a; /* Pink lebih gelap */
    }

    .sidebar-item i {
      color: #fff; /* Putih */
    }

    .sidebar-item i:hover {
      color: #b0003a;
    }

    .sidebar-nav {
      background: transparent;
      color: #fff;
    }

    .sidebar-nav .hide-menu {
        color: white !important;
    }

    .sidebar-item form button.btn-light {
      color: rgb(251, 142, 198) !important;
    }

    /* Body Wrapper */
    .body-wrapper {
      min-height: 100vh; /* Mengatur agar body-wrapper minimal setinggi layar */
      display: flex;
      flex-direction: column; /* Membuat child elements disusun secara vertikal */
    }

    /* Footer */
    .py-6 {
      color: #e91e63; /* Pink pekat */
      margin-top: auto; /* Memastikan footer selalu di bagian bawah */
    }

    .py-6 a {
      color: #b0003a;
      font-weight: bold;
    }

    .py-6 a:hover {
      text-decoration: underline;
      color: #8e1447;
    }

  .dark-mode {
    background-color: #121212;
    color: white;
  }
  .dark-mode .navbar {
    background-color: #1e1e1e !important;
  }
  </style>

<style>
/* Container teks berjalan */
.marquee-container {
  width: 100%;
  overflow: hidden;
  white-space: nowrap;
  position: relative;
}

/* Animasi teks berjalan */
.marquee-text {
  display: inline-block;
  padding-left: 100%;
  font-weight: bold;
  color: #fff; /* Warna pink soft */
  animation: marquee 10s linear infinite;
}

/* Keyframes animasi */
@keyframes marquee {
  from {
    transform: translateX(100%);
  }
  to {
    transform: translateX(-100%);
  }
}

.btn-soft {
  background-color: #ff86b7; /* Warna pink soft */
  color: white;
  border-radius: 50px; /* Membuat tombol membulat */
  padding: 8px 16px;
  border: none;
  transition: all 0.3s ease-in-out;
}

.btn-soft:hover {
  background-color: #ff609d;
  transform: scale(1.05);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

</style>

</head>