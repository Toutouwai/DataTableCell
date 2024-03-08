# Data Table Cell

A simple module that adds an identifying data attribute to each MarkupAdminDataTable cell which is derived from the column header. This makes it easier to target cells in particular columns with CSS and JavaScript.

The attribute added is `data-dtc` and the attribute value is the column header text sanitized as a page name.

For example, for a column with the header "Mod By" the module will add `data-dtc="mod-by"` to the header `<th>`, and to every `<td>` in that column.

MarkupAdminDataTable is used in various places in the ProcessWire admin, including in Lister results.
