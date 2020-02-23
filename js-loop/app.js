var names = ['Anisur', 'Rahman', 'John', 'Deo']
var upperCaseNames = []
for(let i = 0, totalNames = names.length; i < totalNames ; i = i + 1 ) {
    upperCaseNames[i] = names[i].toLowerCase()
}

console.log(upperCaseNames)


var names = ['Anisur', 'Rahman', 'John', 'Deo', 'Kane']
names.push('Hello G')
var upperCaseNames = names.map(name => name.toUpperCase())

console.log(upperCaseNames);