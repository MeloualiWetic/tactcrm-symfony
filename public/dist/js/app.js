// this variable is the list in the dom, it's initiliazed when the document is ready
var $collectionHolder;
// the link which we click on to add new items
var $addNewItem = $('<a href="#" class="btn btn-info">Add new Detail</a>');
// when the page is loaded and ready
$(document).ready(function () {
    $collectionHolder = $('#detail_list');
    // $('.col-form-label').hide();
    // append the add new item link to the collectionHolder
    // $collectionHolder.append($addNewItem);
    // $('#new-detail').append($addNewItem);
    $collectionHolder.data('index', $collectionHolder.find('.detail-facture').length)



         $('#articles-list').change(function (e) {

        $('#article-libelle').val( $('#articles-list').find(":selected").text());
        $('#article-frais').val( $('#articles-list').val());
        $('#article-id').val( $('#articles-list').val());

             var selected = $('#articles-list').val();
             var inputID = $('#article-id').val();


    })

    $('#new-row').click(function (e) {
        // preventDefault() is your  homework if you don't know what it is
        // also look up preventPropagation both are usefull
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
    console.log("new Form " +newForm);
    newForm = newForm.replace(/__name__/g, index);
    newForm = newForm.replace(/div/g, 'td');
    var idLibelle = "facture_detailFactures_"+index+"_designationProduit"
    var idFrais = "facture_detailFactures_"+index+"_prixVente"
    var idArticle = "facture_detailFactures_"+index+"_article"

    // incrementing the index data and setting it again to the collectionHolder
    $collectionHolder.data('index', index+1);
    // create the panel-body and append the form to it
    var $Body = $('<tr class="added-row"></tr>').append(newForm);
    // $panel.append($panelBody);

    addRemoveButton($Body);

    $($collectionHolder).append($Body);

    $('#'+idLibelle).val($('#article-libelle').val());
    $('#'+idFrais).val($('#article-frais').val());
    $('#'+idArticle).val($('#article-id').val);
    $('#'+idArticle).hide();
}

/**
 * adds a remove button to the panel that is passed in the parameter
 * @param $row
 */
function addRemoveButton ($row) {
    // create remove button
    var $removeButton = $('<a style="float: right"  href="#" class="btn btn-danger">Retirer de la selection </a>');
    var $actionTd = $('<td ></td>').append($removeButton);

    $removeButton.click(function (e) {
        e.preventDefault();
    $(e.target).parents('.added-row').slideUp(1000, function () {
        $(this).remove();
    })
    });



    $row.append($actionTd);
}



//add new detail

//remove detail