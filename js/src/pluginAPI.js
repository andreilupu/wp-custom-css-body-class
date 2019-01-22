const { __ } = wp.i18n;

const { Fragment } = wp.element;
const { PluginSidebar, PluginSidebarMoreMenuItem, PluginPostStatusInfo } = wp.editPost;
const { registerPlugin } = wp.plugins;

const {
	PanelBody,
	TextControl,
	CheckboxControl,
	RangeControl
} = wp.components;

const {
	RichText
} = wp.editor;

import MyAutocomplete from "./components/autocompleter";

const CustomBodyClassComponent = () => (
	<Fragment>
		<PluginSidebarMoreMenuItem
			target="sidebar-name"
		>
			Custom Body Class
		</PluginSidebarMoreMenuItem>
		<PluginSidebar
			name="custom-body-class-sidebar"
			title="Custom Body Class"
		>
			<PanelBody>
				<p>Some testing in place</p>
				<MyAutocomplete />
			</PanelBody>
		</PluginSidebar>

	</Fragment>
);

registerPlugin( 'custom-body-class', {
	icon: 'welcome-view-site',
	render: CustomBodyClassComponent,
} );