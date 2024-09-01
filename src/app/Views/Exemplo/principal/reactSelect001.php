<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hybrid Input-Select in React</title>
    <script src="https://unpkg.com/react@17/umd/react.production.min.js"></script>
    <script src="https://unpkg.com/react-dom@17/umd/react-dom.production.min.js"></script>
    <script src="https://unpkg.com/babel-standalone@6.26.0/babel.min.js"></script>
</head>
<body>
    <div id="root"></div>

    <script type="text/babel">
        

        const App = () => {
            const options = ['Apple', 'Banana', 'Cherry', 'Date', 'Elderberry', 'Fig', 'Grape'];

            return (
                <div>
                    <h1>Hybrid Input-Select</h1>
                    <HybridInputSelect options={options} />
                </div>
            );
        };

        const HybridInputSelect = ({ options }) => {
            const [inputValue, setInputValue] = React.useState('');
            const [filteredOptions, setFilteredOptions] = React.useState([]);
            const [isDropdownVisible, setIsDropdownVisible] = React.useState(false);

            React.useEffect(() => {
                const newFilteredOptions = options.filter(option => 
                    option.toLowerCase().includes(inputValue.toLowerCase())
                );
                setFilteredOptions(newFilteredOptions);
                setIsDropdownVisible(newFilteredOptions.length > 0);
            }, [inputValue, options]);

            const handleChange = (e) => {
                setInputValue(e.target.value);
            };

            const handleOptionClick = (option) => {
                setInputValue(option);
                setIsDropdownVisible(false);
            };

            return (
                <div style={{ position: 'relative', display: 'inline-block' }}>
                    <input 
                        type="text" 
                        value={inputValue} 
                        onChange={handleChange} 
                        onFocus={() => setIsDropdownVisible(true)}
                        placeholder="Type to search..."
                        style={{ width: '200px', padding: '5px' }}
                    />
                    {isDropdownVisible && (
                        <ul style={{ 
                            border: '1px solid #ccc', 
                            padding: 0, 
                            margin: 0, 
                            listStyleType: 'none', 
                            position: 'absolute', 
                            width: '100%', 
                            maxHeight: '150px', 
                            overflowY: 'auto', 
                            backgroundColor: '#fff',
                            zIndex: 1
                        }}>
                            {filteredOptions.map((option, index) => (
                                <li 
                                    key={index} 
                                    onClick={() => handleOptionClick(option)}
                                    style={{ 
                                        padding: '5px', 
                                        cursor: 'pointer' 
                                    }}
                                >
                                    {option}
                                </li>
                            ))}
                        </ul>
                    )}
                </div>
            );
        };

        ReactDOM.render(<App />, document.getElementById('root'));
    </script>
</body>
</html>
