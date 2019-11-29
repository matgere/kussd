/* ==========================================================================
 * @author Diodio MBODJ
 * Univers Edu V2
 * kutils.js plugin contient toutes les fonctions utiles du projet
 *  @copyright  2018 Kiwi/2SI Group
 * ==========================================================================
 */
;
(function ($) {

	kutils = function (options) {
		
		var o = {
	            addUrl: '/e/Add/',
	            editUrl: '/e/Update/',
	        };
	        // constructor
		 var construct = function (options) {
	            $.extend(o, options);
	        };
	        
	        
		//formatage date
        this.FormatageDate = function (dateE, action) {
            var dateN;
            var dateNew;
            if (action === 'TEST')
                dateN = dateE;
            else
                dateN = dateE.date;
            
            if (action === 'SEARCH')
                dateNew = dateE;
            else
                dateNew = dateN.substring(0, 10);

            var chD = dateNew.split("-");
            var annee = chD[0];
            var mois = chD[1];
            var jour = chD[2];
            if (mois == 01)
                mois = "Janv"
            else if (mois == 02)
                mois = "Fev"
            else if (mois == 03)
                mois = "Mars"
            else if (mois == 04)
                mois = "Avril"
            else if (mois == 05)
                mois = "Mai"
            else if (mois == 06)
                mois = "Juin"
            else if (mois == 07)
                mois = "Juil"
            else if (mois == 08)
                mois = "Août"
            else if (mois == 09)
                mois = "Sept"
            else if (mois == 10)
                mois = "Oct"
            else if (mois == 11)
                mois = "Nov"
            else if (mois == 12)
                mois = "Dec";
            chD = chD[2] + " " + mois + " " + chD[0]
            return chD;
        };
        // fin
        
        // fonction 
        function ValidateEmail(email) {
            var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
            return expr.test(email);
        }

        
     return construct(options);
    };
}(jQuery));

