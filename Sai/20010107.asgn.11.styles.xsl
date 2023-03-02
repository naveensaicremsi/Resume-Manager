<?xml version="1.0"?>
<xsl:stylesheet version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="/">
        <html>
            <head>
                <title>Aspirants</title>
                <style type="text/css">
                    table {
                        border-collapse: collapse;
                        font-family: Arial, sans-serif;
                        width: 100%;
                    }

                    th, td {
                        border: 1px solid #ddd;
                        padding: 10px;
                    }

                    th {
                        background-color: #f1f1f1;
                    }

                    name {
                        font-weight: bold;
                    }

                    email {
                        color: blue;
                    }

                    skills {
                        margin-bottom: 5px;
                    }

                    skill {
                        display: inline-block;
                        padding: 5px;
                        background-color: #ddd;
                        margin-right: 5px;
                    }

                    education, experience, age, region {
                        font-style: italic;
                    }
                </style>
            </head>
            <body>
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Skills</th>
                        <th>Education</th>
                        <th>Experience</th>
                        <th>Age</th>
                        <th>Region</th>
                    </tr>
                    <xsl:apply-templates select="aspirants/aspirant"/>
                </table>
            </body>
        </html>
    </xsl:template>

    <xsl:template match="aspirant">
        <tr>
            <td><xsl:value-of select="name"/></td>
            <td><xsl:value-of select="email"/></td>
            <td>
                <div class="skills">
                    <xsl:apply-templates select="skills"/>
                </div>
            </td>
            <td><xsl:value-of select="education"/></td>
            <td><xsl:value-of select="experience"/></td>
            <td><xsl:value-of select="age"/></td>
            <td><xsl:value-of select="region"/></td>
        </tr>
    </xsl:template>

    <xsl:template match="skills">
        <div class="skills">
            <xsl:apply-templates select="skill"/>
        </div>
    </xsl:template>

    <xsl:template match="skill">
        <span class="skill">
            <xsl:value-of select="."/>
        </span>
    </xsl:template>

</xsl:stylesheet>
