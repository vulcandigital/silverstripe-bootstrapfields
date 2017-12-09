<div class="panel-group $extraClass" id="$ID" role="tablist" aria-multiselectable="true">

    <div class="panel panel-default<% if $Accordion %> panel-accordion<% if $AccordionLocked %> locked<% end_if %><% end_if %>">
        <div class="panel-heading" role="tab">
            <h4 class="panel-title">
                <% if $Accordion %><a role="button"><% end_if %>
                <span>$Title</span>
                <% if $Description %>
                    <div class="description">$Description</div>
                <% end_if %>
                <% if $Accordion %><i class="accordion-icon fa <% if $AccordionLocked %> fa-lock<% else %>fa-caret-<% if $AccordionState %>down<% else %>up<% end_if %><% end_if %>"></i></a><% end_if %>
            </h4>
        </div>
        <div class="panel-collapse collapse <% if $Accordion %><% if $AccordionState %>in<% end_if %><% else %>in<% end_if %>" role="tabpanel">
            <div class="panel-body">
                <% loop $FieldList %>
                    $Field
                <% end_loop %>
            </div>
        </div>
    </div>
</div>