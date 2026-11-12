<?php
$titre = 'MBC – Accueil';
$page  = 'profil';
include 'header.php';
?>

<h1 style="font-size: 48px; text-align: center;">Profil utilisateur</h1>

<div class="profiles-container">
    <div class="profile-card">
        <img src="images/profil.png" class="profile-img" alt="Avatar utilisateur">
        <h2 class="profile-name">Profil utilisateur</h2>
        <p class="profile-bio">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores nostrum soluta veniam. Ab, culpa cum doloremque doloribus incidunt laboriosam maiores nisi possimus quidem sit. Libero omnis quas reprehenderit tempora voluptates.</p>
        <a href="#" class="profile-btn">Voir le profil</a>
    </div>

    <div class="profile-card">
        <img src="images/profil.png" class="profile-img" alt="Avatar administrateur">
        <h2 class="profile-name">Admin web</h2>
        <p class="profile-bio">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A corporis cum cumque deleniti deserunt ea eligendi est expedita ipsa iure nemo nulla quaerat quam quod recusandae, rem, sequi tempore? Cum.</p>
        <a href="#" class="profile-btn">Voir le profil</a>
    </div>
</div>

<?php include 'footer.php'; ?>