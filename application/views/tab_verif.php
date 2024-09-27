<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau des Rubriques</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            text-align: center;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Tableau des Rubriques</h1>
    <table>
        <tr>
            <th rowspan="2">Rubriques</th>
            <th rowspan="2">Total</th>
            <th rowspan="2">Unité d'oeuvre</th>
            <th rowspan="2">Nature</th>
            <!-- Ajoutez ici une boucle pour les centres -->
            <th colspan="3">Centre 1</th>
            <th colspan="3">Centre 2</th>
            <!-- Répétez selon le nombre de centres -->
        </tr>
        <tr>
            <!-- Ajoutez ici une boucle pour les sous-colonnes des centres -->
            <th>%</th>
            <th>Fixe</th>
            <th>Variable</th>
            <th>%</th>
            <th>Fixe</th>
            <th>Variable</th>
            <!-- Répétez selon le nombre de centres -->
        </tr>
        
        <!-- Ajoutez ici une boucle pour les rubriques -->
        <tr>
            <td>Rubrique Exemple</td>
            <td>0,00</td>
            <td>kg</td>
            <td>Fixe</td>
            <!-- Répétez les colonnes pour chaque centre -->
            <td>0,00</td>
            <td>0,00</td>
            <td>0,00</td>
            <td>0,00</td>
            <td>0,00</td>
            <td>0,00</td>
            <!-- Répétez selon le nombre de centres -->
        </tr>

        <!-- Ligne des totaux des rubriques -->
        <tr>
            <th>Total des rubriques</th>
            <th>0,00</th>
            <th colspan="2"></th>
            <th></th>
            <th>0,00</th>
            <th>0,00</th>
            <th></th>
            <th>0,00</th>
            <th>0,00</th>
            <!-- Répétez selon le nombre de centres -->
        </tr>

        <!-- Ligne des totaux par centre -->
        <tr>
            <th colspan="4">Total par centre</th>
            <th colspan="3">0,00</th>
            <th colspan="3">0,00</th>
            <!-- Répétez selon le nombre de centres -->
        </tr>
    </table>
</body>
</html>
" je veux que tu ajoute des colonnes et des lignes a ce tableau:"<!-- <?php 
    echo "<pre>";
    // var_dump($tabRubrique[4]->secteur);
    echo "</pre>";
?> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1">
        <tr>
            <th rowspan="2">Rubriques</th>
            <th rowspan="2" >Total</th>
            <th rowspan="2" >Unite d'oeuvre</th>
            <th rowspan="2" >Nature</th>
            <?php for ($i=0; $i < count($secteurs) ; $i++) { ?> 
                <th colspan="3"> <?php echo $secteurs[$i]["nomination"]; ?> 
                </th>
                
            <?php } ?>
        </tr>
        <tr>
        <?php for ($i=0; $i < count($secteurs) ; $i++) { ?> 
                <th> % </th>
                <th>Fixe</th>
                <th>Variable</th>
            <?php } ?>
        </tr>
        <?php 
            foreach ($tabRubrique as $rubSect) { ?>
                <tr>
                    <td><?php echo $rubSect->rubrique["nom"]; ?></td>
                    <td><?php echo $rubSect->rubrique["total"]; ?></td>
                    <td><?php echo $rubSect->rubrique["uniteOeuvre"]; ?></td>
                    <td><?php echo $rubSect->rubrique["nomNature"]; ?></td>
                    
                </tr>
            <?php } ?>
    </table>
</body>
</html>
