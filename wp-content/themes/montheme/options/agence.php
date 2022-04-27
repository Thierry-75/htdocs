<?php

class AgenceMenuPage {

        const GROUP = 'agence_options';

    public static function register()
    {
            add_action('admin_menu',[self::class,'addMenu']);
            add_action('admin_init',[self::class, 'registerSettings']);
    }

    public static function registerSettings()
    {
            register_setting(self::GROUP,'agence_horaire',['default'=>'agence fermée']);
            add_settings_section('agence_options_section','paramètres',function () {
                echo"Vous pouvez ici gérer les paramètres liés à l'agence";
        }, self::GROUP);
           add_settings_field('agence_options_horaire',"Horaires d'ouverture",function(){
                ?>
                <textarea name="agence_horaire"  cols="30" rows="10" style="width: 100%"><?= esc_html(get_option('agence_horaire')) ?></textarea>
                <?php
           }, self::GROUP,'agence_options_section');   

    }

    public static function addMenu()
    {
        add_options_page("Gestion de l'agence","Agence","manage_options","agence_options",[self::class, 'render']);
    }

    public static function render()
    {
        ?>
        <h1>Gestion de l'agence</h1>

        <form action="options.php" method="post">
            <?php settings_fields(self::GROUP ) ?>
            <?php do_settings_sections(self::GROUP); ?>
            <?php submit_button() ?>
        </form>
        <?php
    }

}