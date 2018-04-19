/**
* StatsController
*
* @description :: Server-side logic for managing statss
* @help        :: See http://sailsjs.org/#!/documentation/concepts/Controllers
    */

module.exports = {

    getInfos: function(req, res) {
        Commande.find({}, function(err, found){
            console.log("hello");
            var allCommandes = {commandes: found};
            console.log(allCommandes.commandes[0]);

            var nbTotalCmd = 0;
            var nbRepasTotal = 0;
            var prixTotal = 0;

            for(var i = 0; i < allCommandes.commandes.length;i++){
                nbTotalCmd = nbTotalCmd + 1;
                nbRepasTotal = nbRepasTotal + allCommandes.commandes[i].nbRepas;
                prixTotal = prixTotal + allCommandes.commandes[i].prixTotal;
            }

            console.log(nbTotalCmd);
            console.log(nbRepasTotal);
            console.log(prixTotal);

            var nbRepasMoyen = nbRepasTotal / allCommandes.commandes.length;
            var prixMoyen = prixTotal / allCommandes.commandes.length;

            nbRepasMoyen = Math.round(nbRepasMoyen * 100) / 100;
            prixMoyen = Math.round(prixMoyen * 100) / 100;

            console.log("nb repas moyen et prix moyen :")
            console.log(nbRepasMoyen);
            console.log(prixMoyen);


            return res.view( 'stats', {
                allCommandes :allCommandes,
                nbRepasMoyen : nbRepasMoyen,
                prixMoyen : prixMoyen,
                nbTotalCmd : nbTotalCmd }
            );
        });
    }
};