const { withSelect } = wp.data;

/**
const autocompleters = [
	{
		name: 'custom-classes',
		// The prefix that triggers this completer
		triggerPrefix: '',
		isDebounced: true,
		// The option data
		options: [], // look for a way of getting classes inhere,
		getOptionLabel: option => (
			<span>
				<span className={"dashicons dashicons-" + option.id } ></span> { option.name }
			</span>
		),
		// Declares that options should be matched by their name
		getOptionKeywords: option => [ option.name ],
		// Declares completions should be inserted as abbreviations
		getOptionCompletion: option => (
			option.id
		)
	}
];

<RichText
tagName="p"
onChange={ ( name ) => { setAttributes( { name } ) } }
value={ name }
autocompleters={ autocompleters }
multiline={false}
placeholder="Add custom classes"
/>
*/

const { Autocomplete } = wp.components;

const { RichText } = wp.editor;

const MyAutocomplete = () => {
    const autocompleters = [
        {
            name: 'fruit',
            // The prefix that triggers this completer
            triggerPrefix: '~',
            // The option data
            options: [
				{ visual: '🍎', name: 'Apple', id: 1 },
				{ visual: '🍊', name: 'Orange', id: 2 },
				{ visual: '🍇', name: 'Grapes', id: 3 },
            ],
            // Returns a label for an option like " Orange"
            getOptionLabel: option => (
                <span>
                    <span className="icon" >{ option.visual }</span>{ option.name }
                </span>
            ),
            // Declares that options should be matched by their name
            getOptionKeywords: option => [ option.name ],
            // Declares that the Grapes option is disabled
            isOptionDisabled: option => option.name === 'Grapes',
            // Declares completions should be inserted as abbreviations
			getOptionCompletion: option => (
				option.id
			),
        }
    ];

	const name = 'test';

    return (
        <div>

			<RichText
					tagName="p"
					onChange={ ( name ) => { console.log( { name } ) } }
					value={ name }
					autocompleters={ autocompleters }
					multiline={false}
					placeholder="Search here..."
					unstableOnFocus={ ( value ) => {
						// @TODO force a full selection when the curson is not at the end
						const selection = window.getSelection();
						console.log( selection )
					}}
				/>
            <p>Type ~ for triggering the autocomplete.</p>
        </div>
    );
};

export default MyAutocomplete;