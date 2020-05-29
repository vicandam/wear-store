

new Vue({

  el: '#vue-wrapper',

  data: {
    item_attributes: [],
    attributes: [],

    newAttribute: '',
    attrib_id: '',
    attrib_val: '',

  },

  mounted() {        
    this.getAttribute();  
  },

  methods: {
    saveAttribute: function() {
      var attribute = document.getElementById('attribute');
      
      if (attribute.value == '') {
        $('#attribute').focus();
        Command: toastr["error"]("Attribute field is required.");
      }
      else{
        axios.post('/save-attribute', {attribute: attribute.value}).then(function (response) {
        Command: toastr["success"]("Attribute has been added successfully.");

        $('#attribute').val('');
      });

      this.getAttribute();
      }
    },

    editAttribute(id) {
      var attribute = document.getElementById('value_'+id);
      
      $('#edit_'+id).modal('toggle');

      axios.patch('/edit-attribute', {id: id, value: attribute.value}).then(function (response) {
        Command: toastr["success"]("Attribute value saved successfully.");
      })
      this.getAttribute();
    },

    editValue(id) {
      var attribute = document.getElementById('attrvalue_'+id);
      
      $('#edit_value'+id).modal('toggle');

      axios.patch('/edit-attrvalue', {id: id, value: attribute.value}).then(function (response) {
        Command: toastr["success"]("Attribute value saved successfully.");
      })
      this.getAttribute();
    },

    getAttribute: function() {
      axios.get('/get-attribute').then(response => 
        {
          this.attributes = response.data.attribute;
          this.item_attributes = response.data.item_attribute;
          console.log(response.data.item_attribute);
        });
    },

    addAttributeValue() {
      var attr_val = document.getElementById('attr_value');

      axios.post('/add-value/' + this.attrib_id, {value: attr_val.value}).then(function (response) {
        Command: toastr["success"]("Attribute value has been added successfully.");

        $('#attr_value').val('');
      });

      this.getAttribute();
    },

    onClickAdd(id) {
      this.attrib_id = id;
    },

    selected(name, id) {
      if (id) {
        if ($('#'+id).prop("checked") == true) {
          Command: toastr["success"](name + ' has been selected.');
        }
      }
    }

  }

})
    