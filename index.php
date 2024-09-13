
REPONSE TEST DEVELOPPEUR WEB - LAB CONCEPTS

//Exercice 1

    Les conditions 2 et 3 sont déjà incluses dans la condition 1.
    gr.fk_user = 25 est toujours vrai.
    Ensuite, on ajoute : soit la réalisation n'est pas faite donc gr.realisee = 0, soit l'artiste est NULL donc gr.fk_artiste IS NULL.

    Pour simplifier le code on aura:

    <?php
    gr.fk_user = 25 AND (gr.realisee = 1 OR gr.fk_artiste IS NULL);
    ?>

//Exercice 2

    La variable $currentDate est déjà une chaîne de caractères au format "d-m-Y", il est donc inutile de la reformater donc :

            $tmpDate = $currentDate;

//Exercice 3

    Les deux blocs de conditions font la même action, on peut le fusionner et vérifier uniquement si $user->rights->relance->notes_de_tout_lemonde est vrai.

    Donc on peut simplifier le code ainsi :

        <?php if ($user->rights->relance->notes_de_tout_lemonde == 1) { ?>
            <a class="newEditRelance"
               href="<?php echo $urlRechargerPage ?>?window=iframe&idRelance=<?php echo $note_relance->rowid ?>&page=<?php echo $page; ?><?php echo $paramUrl; ?>">
                <?php echo img_picto("Modifier", "picto_modif_date") ?>
            </a>
        <?php } ?>



//Exercice 4


<?php
function organiserEvenements($evenements) {
    // On va créer un tableau pour stocker les événements organisés par date
    $datesEvenements = [];

    foreach ($evenements as $evenement) {
        // On va créer des objets DateTime à partir des dates de début et de fin
        $dateDebut = new DateTime($evenement->debut);
        $dateFin = new DateTime($evenement->fin);

        // On va parcourir chaque jour de l'événement
        while ($dateDebut <= $dateFin) {
                //1) // Pour récupérer le mois et l'année
            $moisAnnee = $dateDebut->format('m-Y');
                //2) // Pour récupérer le jour du mois
            $jour = $dateDebut->format('d');

        // On va initialiser le tableau pour le mois et l'année
            if (!array_key_exists($moisAnnee, $datesEvenements)) {
                $datesEvenements[$moisAnnee] = [];
            }

            // On ajoute chaque artiste à cet événement
            foreach ($evenement->artisteListe as $artiste) {
                $idArtiste = $artiste->rowid;

                // On vérifie si l'id de l'artiste existe dans le tableau
                if (!isset($datesEvenements[$moisAnnee][$idArtiste])) {
                    $datesEvenements[$moisAnnee][$idArtiste] = [];
                }

                // On ajoute l'événement au bon jour
                $datesEvenements[$moisAnnee][$idArtiste][$jour][] = (object)[
                    'nomEvent' => $evenement->nomEvent,
                    'idEvent' => $evenement->idEvent
                ];
            }
            // On aasse au jour suivant
            $dateDebut->modify('+1 day');
        }
    }
    return $datesEvenements;
}
?>


//Exercice 5

<?php
function getStatutLibelle($idStateSel) {
    return $this->allowedState[$idStateSel] ?? "";

?>
}


//Exercice 6



Exercice 7

1) Pour remonter le rowid minimum uniquement pour les fk_booking_source en doublon

    SELECT MIN(rowid) as min_rowid, fk_booking_source
    FROM book_valid
    GROUP BY fk_booking_source
    HAVING COUNT(fk_booking_source) > 1;

2) Pour supprimer les lignes en doublon en conservant la ligne avec le rowid minimum

    DELETE FROM book_valid
    WHERE rowid NOT IN (
    SELECT MIN(rowid)
    FROM book_valid
    GROUP BY fk_booking_source
    HAVING COUNT(fk_booking_source) > 1
    );



//Exercice 8

    Ce code effectue une requête AJAX de type POST vers l'URL DOL_URL_ROOT + '/custom/relance/ajax/structure.php'.
    Il envoie la valeur du fk_soc_value saisie dans le champ sous forme de paramètre : 'fk_structure'.
    Lors de la réponse, il parse le résultat JSON pour mettre à jour la valeur de #fk_soc.
    L'objectif est de récupérer les données de l'URL en fonction de fk_soc_value et de mettre à jour le champs fk_soc avec les données récupérées.


//Exercice 9

    La couleur est #500. On le voit à la ligne .div.error, color: #500 ci dessous :
    div.error{background-color:#EFCFCF;border:1px solid #DC9CAB;border-radius:6px;color:#500;font-weight:700;margin:.5em 0;padding:.2em}

//Exercice 10

    A l'aide de l'inspecteur d'élément, dans l'onglet style et en sélectionnant l'élément en question dans l'html de la page

//Exercice 11

    git add new.php
    git commit -m "Ajout du fichier new.php"
    git push origin main

//Exercice 12

    git pull origin main

//Exercice 13

    - Analyser le bug, essayer de le reproduire, vérifier les logs pour comprendre ce qui ne fonctionne pas et trouver une solution pour le corriger
    - Corriger le bug
    - Tester la correction du bug pour être sur qu'il est bien corrigé
