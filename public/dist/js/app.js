// this variable is the list in the dom, it's initiliazed when the document is ready
var $collectionHolder;
// the link which we click on to add new items
var $addNewItem = $('<a href="#" class="btn btn-info">Add new Detail</a>');
// when the page is loaded and ready
$(document).ready(function () {
    $collectionHolder = $('#detail_list');
    // calculate();
    // $('.col-form-label').hide();
    // append the add new item link to the collectionHolder
    // $collectionHolder.append($addNewItem);
    // $('#new-detail').append($addNewItem);
    $collectionHolder.data('index', $collectionHolder.find('.detail-facture').length)



    $('#articles-list').change(function (e) {



        $('#article-libelle').val($('#articles-list').find(":selected").text());
        $('#article-frais').val($('#articles-list').val());
        // $('#article-id').val( $('#articles-list').val());


        // requestGetJSON('articleController/get_article_by_id/' + id).done(function (response) {
        //     $('#article-frais').val( response.prix );

        // });

    })

    $('#new-row').click(function (e) {

        e.preventDefault();
        // create a new form and append it to the collectionHolder
        // and by form we mean a new panel which contains the form
        addNewForm();
    })

});
/*
 * creates a new form and appends it to the collectionHolder
 */
function addNewForm() {

    // getting the prototype
    // the prototype is the form itself, plain html
    var prototype = $collectionHolder.data('prototype')

    // get the index
    // this is the index we set when the document was ready, look above for more info
    var index = $collectionHolder.data('index');
    // create the form
    var newForm = prototype;
    // replace the __name__ string in the html using a regular expression with the index value
    console.log("new Form " + newForm);
    newForm = newForm.replace(/__name__/g, index);
    newForm = newForm.replace(/div/g, 'td');
    var idLibelle = "facture_detailFactures_" + index + "_designationProduit"
    var idArticle = "facture_detailFactures_" + index + "_article"
    var idFrais = "facture_detailFactures_" + index + "_prixVente"
    var idQte = "facture_detailFactures_" + index + "_qte"


    // incrementing the index data and setting it again to the collectionHolder
    $collectionHolder.data('index', index + 1);
    // create the panel-body and append the form to it
    var $Body = $('<tr class="added-row"></tr>').append(newForm);
    // $panel.append($panelBody);

    addRemoveButton($Body,index);

    $($collectionHolder).append($Body);
    var frais = $('#article-frais').val();
    var qte = $('#article-qte').val();
    // var HT =+ frais * qte;
    // console.log('HT = '+HT);
    $('#' + idLibelle).val($('#article-libelle').val());
    $('#' + idFrais).val(frais);
    $('#' + idQte).val(qte);
    calculate(index);
    // $('#' + idArticle).val($('#article-id').val);

    $('#' + idArticle).hide();
}

function calculate(index) {
    // var index = $collectionHolder.data('index');
    console.log('index = '+index);

    var HT = 0;
    for (i = 0; i < index; i++){
        var idFrais = "facture_detailFactures_" + i + "_prixVente"
        var idQte = "facture_detailFactures_" + i + "_qte"

        var frais = parseFloat($('#' + idFrais).val());
        var qte = parseFloat($('#' + idQte).val());
         HT = HT + qte*frais;
         console.log('HT '+HT)
    }

    $("#calculation-ht").html(HT);

    
}

/**
 * adds a remove button to the panel that is passed in the parameter
 * @param $row
 */
function addRemoveButton($row,index) {
    // create remove button
    var $removeButton = $('<a style="float: right"  href="#" class="btn btn-danger">Retirer de la selection </a>');
    var $actionTd = $('<td ></td>').append($removeButton);
    // var index = $collectionHolder.data('index');
    $removeButton.click(function (e) {
        e.preventDefault();
        $(e.target).parents('.added-row').slideUp(1000, function () {
            $(this).remove();
            index = parseInt(index--) ;
            console.log('index from remove '+index)
            calculate(index);
        })
    });



    $row.append($actionTd);
}

