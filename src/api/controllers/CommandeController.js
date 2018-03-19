/**
 * CommandeController
 *
 * @description :: Server-side logic for managing commandes
 * @help        :: See http://sailsjs.org/#!/documentation/concepts/Controllers
 */

module.exports = {
    createCommande: function(req, res) {
        Commande.create( { acheteur: req.param('acheteur'), nbRepas: req.param('nbRepas'), nomRepas: req.param('nomRepas'), date: req.param('date'), prixTotal: req.param('prixTotal') }, function(err,created){
            if(!err) {
                console.log('Article créé : '+ created.nomRepas +', ayant pour ID : '+created.id+'.');
                res.redirect('/commandes');
            }
            else {
                return err;
            }
        });
    },

    getCommandes: function(req, res) {
        Commande.find({}, function(err, found){
            res.view( 'commandes', {commandes: found} );
        });
    }
};

