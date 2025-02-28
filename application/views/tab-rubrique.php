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
            <th rowspan="2">Unité d'œuvre</th>
            <th rowspan="2">Nature</th>
            <?php for ($i = 0; $i < count($secteurs); $i++) { ?> 
                <th colspan="3"><?php echo $secteurs[$i]["nomination"]; ?></th>
            <?php } ?>
            <th colspan="3">Total</th>
        </tr>
        <tr>
            <?php for ($i = 0; $i < count($secteurs); $i++) { ?> 
                <th>%</th>
                <th>Fixe</th>
                <th>Variable</th>
            <?php } ?>
            <th>Fixe</th>
            <th>Variable</th>
        </tr>

        <!-- Ligne pour chaque rubrique -->
        <?php foreach ($tabRubrique as $rubSect) { ?>
            <tr>
                <td><?php echo $rubSect->rubrique["nom"]; ?></td>
                <td><?php echo $rubSect->rubrique["total"]; ?></td>
                <td><?php echo $rubSect->rubrique["uniteOeuvre"]; ?></td>
                <td><?php echo $rubSect->rubrique["nomNature"]; ?></td>
                
                <?php 
                // Variables pour les totaux fixes et variables
                $sommeFixe = 0;
                $sommeVariable = 0;

                foreach ($secteurs as $secteur) {
                    $corresponding_rubsecteur = null;
                    foreach ($rubsecteurs as $rubsecteur) {
                        if ($rubsecteur->idSecteur == $secteur["idSecteur"] && $rubsecteur->idRubrique == $rubSect->rubrique["idRubrique"]) {
                            $corresponding_rubsecteur = $rubsecteur;
                            break;
                        }
                    }
                    
                    if ($corresponding_rubsecteur) {
                        echo '<td>' . $corresponding_rubsecteur->pourcentage . '</td>';
                        
                        if ($corresponding_rubsecteur->idNature == 1) { 
                            // Si c'est variable
                            echo '<td>0</td>';
                            echo '<td>' . $corresponding_rubsecteur->cout . '</td>'; 
                            $sommeVariable += $corresponding_rubsecteur->cout;
                        } elseif ($corresponding_rubsecteur->idNature == 2) { 
                            // Si c'est fixe
                            echo '<td>' . $corresponding_rubsecteur->cout . '</td>';
                            echo '<td>0</td>';
                            $sommeFixe += $corresponding_rubsecteur->cout;
                        }
                    } else {
                        echo '<td></td><td></td><td></td>';
                    }
                } ?>

                <!-- Remplacement de FDFFFG par la somme des coûts fixes et variables -->
                <td><?php echo $sommeFixe; ?></td>
                <td><?php echo $sommeVariable; ?></td>
            </tr>
        <?php } ?>

        <!-- Ligne des totaux des rubriques -->
        <tr>
            <th>Total des rubriques</th>
            <th><?php echo($totalRubrique); ?></th>
            <th colspan="2"></th>
            <?php 
            // Initialiser des totaux pour les coûts fixes et variables
            $totalCoutFixe = array_fill(0, count($secteurs), 0);
            $totalCoutVariable = array_fill(0, count($secteurs), 0);
            
            // Remplir les totaux
            foreach ($coutParNature as $cout) {
                $secteurIndex = array_search($cout['secteur'], array_column($secteurs, 'nomination'));
                if ($secteurIndex !== false) {
                    if ($cout['nature'] === 'Fixe') {
                        $totalCoutFixe[$secteurIndex] += $cout['cout'];
                    } elseif ($cout['nature'] === 'Variable') {
                        $totalCoutVariable[$secteurIndex] += $cout['cout'];
                    }
                }
            }

            // Afficher les totaux pour chaque secteur
            for ($i = 0; $i < count($secteurs); $i++) { ?>
                <td></td> <!-- Pourcentage Total -->
                <td><?php echo $totalCoutFixe[$i]; ?></td>
                <td><?php echo $totalCoutVariable[$i]; ?></td>
            <?php } ?>
            <td><?php echo array_sum($totalCoutFixe); ?></td>
            <td><?php echo array_sum($totalCoutVariable); ?></td>
        </tr>

        <!-- Ligne des totaux par centre -->
        <tr>
            <th colspan="4">Total par centre</th>
            <?php foreach ($coutTotalSecteur as $parsect) { ?>
                <th colspan="3"><?php echo $parsect['cout']; ?></th>
            <?php } ?>
            <td colspan="2"><?php echo $coutTotalFV; ?></td>
			
		</tr>
    </table>
</body>
</html>
