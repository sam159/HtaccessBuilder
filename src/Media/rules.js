
var rules = {
  init: function() {
    var self = this;
    this.reloadRules();
    $('#form-add-rule').submit(function(){
      do_ajax('add', {type:$('#field-rule-select').val()}, function(data) {
        if (typeof data.error !== 'undefined')
          alert(data.error);
        else
          self.editRule(data.id);
        self.reloadRules();
      });
      return false;
    });
  },
  
  showListing: function() {
    do_ajax('listing', {}, function(data) {
      var lines = data.split(/\r?\n|\r/).length + 2;
      $('#listing-code').show();
      $('#preview-code').hide();
      $('#listing-code textarea').html(data).attr('rows', lines);
    });
  },
  
  hideListing: function() {
    $('#listing-code').hide();
    $('#preview-code').show();
  },
  
  reloadRules: function() {
    var self = this;
    do_ajax('rules', {}, function(data) {
      $('#preview-code').html(data);
      $('.action-delete').click(function(){
        return confirm('Delete?');
      });
      $('#rule-list').disableSelection().sortable({
        stop: function() {
          self.updateOrder();
        }
      });
      $('.rule-actions').hover(function(){
        $('#rule-list').sortable( "option", "disabled", true );
      }, function(){
        $('#rule-list').sortable( "option", "disabled", false );
      });
    });
  },
  
  updateOrder: function(e, ui) {
    var self = this;
    $('#rule-list').sortable( "option", "disabled", true );
    $('.rule-actions').remove();
    var newOrder = [];
    $('#rule-list .rule').each(function(){
      newOrder.push($(this).data('rule-id'));
    });
    do_ajax('updateOrder', {order: newOrder}, function(data) {
      self.reloadRules();
    });
  },
  
  editRule: function(id){
    var self = this;
    do_ajax('edit', {id: id}, function(data) {
      $('#rule-edit').html(data);
      self.prepareForm();
      $('.tooltip').tooltipster({
        position: 'top-right'
      });
    });
  },
  
  prepareForm: function(){
    var self = this;
    
    $('#rule-edit .type-text').keyup(function(){
      var lines = $(this).val().split(/\r?\n|\r/).length;
      if (lines < 2)
        lines = 2;
      $(this).attr('rows', lines);
    }).keyup();
    $('#rule-edit .type-dualtext').keyup(function(){
      var textareas = $('.type-dualtext[name="'+$(this).attr('name')+'"]');
      
      var lines = 2;
      
      textareas.each(function(){
        var ta_lines = $(this).val().split(/\r?\n|\r/).length;
        if (ta_lines > lines)
          lines = ta_lines;
      });
      if (lines < 2)
        lines = 2;
      
      $('.type-dualtext[name="'+$(this).attr('name')+'"]').attr('rows', lines);
    }).keyup();
  },
  
  
  cancelRuleEdit : function() {
    $('#rule-edit').html('');
  },
  
  completeRuleEdit: function() {
    var self = this;
    var params = {};
    $('#rule-edit form input.multi').each(function(){
      params[$(this).attr('name')] = [];
    });
    $('#rule-edit form input[type!="submit"][type!="checkbox"], #rule-edit form textarea, #rule-edit form input:checked[type="checkbox"]').each(function(){
      var elem = $(this);
      var name = elem.attr('name');
      if (/^.*\[\]$/i.test(name)) {
        if (params[name])
          params[name].push(elem.val());
        else
          params[name] = [elem.val()];
      }
      else
        params[name] = elem.val();
    });
    do_ajax('save', params, function(data) {
      if (typeof data.error === 'undefined')
      {
        self.reloadRules();
        $('#rule-edit').html('');
      }
      else
      {
        alert(data.error);
      }
    });
    return false;
  },
  
  deleteRule: function(id) {
    var self = this;
    this.cancelRuleEdit();
    do_ajax('delete', {id: id}, function() {
      self.reloadRules();
    });
  }
};