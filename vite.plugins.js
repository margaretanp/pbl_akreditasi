// import { promises as fs } from 'fs'
// import path from 'path'

// export default function LaravelLangToJson () {
//   return {
//     name: 'laravel-lang-to-json',
//     async buildStart() {
//       const base = 'resources/lang'
//       const groups = ['en', 'id']
//       for (const g of groups) {
//         const php = await import('php-array-to-json')
//         const src = path.join(base, g, 'messages.php')
//         const dst = path.join('resources/js/lang', g, 'messages.json')
//         const json = php(await fs.readFile(src, 'utf8'))
//         await fs.mkdir(path.dirname(dst), { recursive: true })
//         await fs.writeFile(dst, JSON.stringify(json))
//       }
//     },
//   }
// }
