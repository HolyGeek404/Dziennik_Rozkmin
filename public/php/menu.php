<?php
    require_once 'connect.php';
    
    function generateMenu( $parent_id = NULL )
    {
        if ( isset( $_SESSION[ 'user_id' ] ) ) {
            $query = "SELECT * FROM menu WHERE parent_id " . ( $parent_id === NULL ? "IS NULL" : "= $parent_id" );
            $result = executeQuery( ConnectToDatabase(), $query );
            $menu = '<ul>';
            while ( $row = $result->fetch_assoc() ) {
                $menu .= "<li><a href='{$row['url']}'><button>{$row['name']}</button></a>";
                
                $subMenu = generateMenu( $row[ 'id' ] );
                if ( $subMenu !== '<ul></ul>' ) {
                    $menu .= $subMenu;
                }
                
                $menu .= "</li>";
            }
            $menu .= '</ul>';
        } else {
            $menu = '<a href="/"><button>Strona główna</button></a>';
        }
        
        return $menu;
    }
