/**
 * Commande.js
 *
 * @description :: TODO: You might write a short summary of how this model works and what it represents here.
 * @docs        :: http://sailsjs.org/documentation/concepts/models-and-orm/models
 */

module.exports = {

  attributes: {
    id:{
      autoIncrement: true,
        primaryKey: true
    },

    acheteur:{
      type:'string',
        required: true
    },
    nbRepas:{
      type:'integer',
        required: true
    },
    nomRepas:{
      type: 'string',
        required : true
    },
    date:{
      type:'date',
        required: true
    },
    prixTotal:{
      type: 'integer',
        required:true
    }
  }
};
