<?php if(!empty($params['error'])): ?>
    <div class="alert alert-danger text-center alert-dismissible w-75 fade show" role="alert">
        <?php
        switch ($params['error']) {
            case '1':
                echo 'Brak produktu o podanym kodzie';
                break;
            case '2':
                echo 'Nie masz wystarczającej ilości środków';
                break;
            case '3':
                echo 'Wybrany produkt się skończył';
                break;
            case '4':
                echo 'Niepoprawny login lub hasło';
                break;
            case '5':
                echo 'Nie udało się uzupełnić tego produktu';
                break;
            case '6':
                echo 'Odmowa dostępu';
                break;
            case '7':
                echo 'Nie jesteś zalogowany';
                break;
            default:
                echo 'Wystąpił błąd';
                break;
        }
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if(!empty($params['message'])): ?>
    <div class="alert alert-success alert-custom text-center alert-dismissible w-75 show" role="alert">
        <?php
        switch ($params['message']) {
            case 'logged':
                echo 'Zalogowano jako zarządca automatu';
                break;
            case 'logout':
                echo 'nastąpiło wylogowanie';
                break;
            case 'updated':
                echo 'Uzupełniono wybrany produkt';
                break;
            case 'bought':
                echo 'Zakupiono produkt';
                break;
        }
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>


