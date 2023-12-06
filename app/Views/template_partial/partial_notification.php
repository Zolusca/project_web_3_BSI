<!------ INI NONTIFIKASI PESAN ------->
<?php if(isset($data)){
    echo '<div class="bg-yellow-200 text-black border-l-4 m-7 border-yellow-600 p-4" role="alert">';
    echo '<p class="font-bold">Notifikasi!</p>';

    if(array_key_exists('errorMessage',$data)){

        foreach ($data['errorMessage'] as $value){
            echo '<p>'.$value.'</p>';
        }
    }elseif (array_key_exists('message',$data)){
        echo '<p>'.$data['message'].'</p>';
    }
    echo '</div>';
}
?>
<!------ INI NONTIFIKASI PESAN ------->
