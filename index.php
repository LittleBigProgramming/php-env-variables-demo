<?php
include 'inc/bootstrap.php';
$pageTitle = "Developers Don't Commit .envs";
$section = "home";
require 'inc/header.php';
?>
    <div class="wrapper">
        
        <?php
        $respository = json_decode(getenv('REPOSITORY'));
        echo $respository->type;

        switch ($respository->type) {
            case 'text':
                $file = file($respository->source);
                $quote = $file[array_rand($file)];
                break;
            case 'sqlite':
                try {
                    $db = new PDO("sqlite:/www/" . $repository->source);
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $result = $db->query('SELECT quote FROM Quotes ORDER BY RANDOM() LIMIT 1');
                    $quote = $result->fetchColumn();
                    break;
                } catch (Exception $e) {
                    echo "Error: " . $e->getMessage();
                    break;
                }
            default:
                $quote ='It Works On My Machine';
        }

        echo '<h1>' . $quote . '</h1>';
        ?>
    </div>
<?php
require 'inc/footer.php';