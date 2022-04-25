<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'wordpress' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define( 'DB_COLLATE', '' );

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '5]dorBwX lvMw^bC)[,1)X;oWt}iP?v:3^.(0c(FLBIW1`.eWlb/F^nwxbxF[TU*' );
define( 'SECURE_AUTH_KEY',  'EMev,{%mo[!T5mSXBNj(*p4$XRn16$5yHf,A@ve4< 76#jd8JZ-28>m.f?l<6R#o' );
define( 'LOGGED_IN_KEY',    'Jop,OOTABeG(o^_;`i6ekNC{fQQkRTED/=@h_V6|x.U``nTX:-]FYO9g6,1J{=3v' );
define( 'NONCE_KEY',        '(n(y=t@m7%TGamd_Q{~e$+)Bj61WNtL>2&iLsg)@&IwT@}Nx[eg/!#-J5Urt~IQ$' );
define( 'AUTH_SALT',        'D8tuY7sN3Sdi3G{=w;i&+F/N]`SkL>t7{8P!q 19%a1vwgq&cuqmUpg(Hx[O*Z`]' );
define( 'SECURE_AUTH_SALT', 'U%5/S=_?.4zty5T!C?(,&2;6+A[Qi:a|WE/uB}z7IC+Eg^ Ed=_Vb.Z.3_?wx{FE' );
define( 'LOGGED_IN_SALT',   '0mOsE0&!W$XShh`hJuH~C]X3@5|4G@zFV-t4s3uoe=$USubj?j<_>%c .p-<9 3=' );
define( 'NONCE_SALT',       'b*SByv$*Ps3M4I-#j{?onUQtK?$Ph%vQ]:SBz5 NGvB?THh%R ~#KryGbFn{]$VM' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( ! defined( 'ABSPATH' ) )
  define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once( ABSPATH . 'wp-settings.php' );
